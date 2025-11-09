<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\ProductoImagenModel;
use App\Models\CategoriaModel;

class Admin extends BaseController
{
	public function index()
	{
		$data['title'] = 'Dashboard Principal';

		return $this->loadAdminView('admin/dashboard/index', $data);
	}

	public function productos()
	{
		helper('form');
		$data['title'] = 'Gestión de Productos';

		$productoModel = new  ProductoModel();

		$data['productos'] = $productoModel->getProductosConCategoria();

		return $this->loadAdminView('admin/productos/index', $data);
	}

	public function crearProducto()
	{
		helper('form');
		$data['title'] = 'Crear Nuevo Producto';

		$categoriaModel = new  CategoriaModel();

		$data['categorias'] = $categoriaModel->findAll();

		return $this->loadAdminView('admin/productos/crear', $data);
	}

	public function crear_guardar()
	{
		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/productos/crear'));
		}

		helper(['form', 'filesystem']);
		$productoModel = new  ProductoModel();
		$productoImagenModel = new  ProductoImagenModel();

		$rules = [
			'nombre'           => 'required|min_length[3]|max_length[150]',
			'descripcion'      => 'permit_empty|string',
			'precio'           => 'required|decimal|greater_than[0]',
			'stock'            => 'required|integer|greater_than_equal_to[0]',
			'id_categoria'     => 'required|integer',
			'imagen_principal' => 'uploaded[imagen_principal]|max_size[imagen_principal,2048]|ext_in[imagen_principal,jpg,jpeg,png]',
			'tipo'             => 'required|in_list[estandar,personalizable]',
		];

		for ($i = 1; $i <= 5; $i++) {
			$rules["imagen_secundaria_{$i}"] = 'max_size[imagen_secundaria_' . $i . ',2048]|ext_in[imagen_secundaria_' . $i . ',jpg,jpeg,png]';
		}

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$files = $this->request->getFiles();
		$imagenesSubidas = [];
		$rutaUpload = ROOTPATH . 'public/uploads/productos/';

		if (!is_dir($rutaUpload)) {
			mkdir($rutaUpload, 0777, true);
		}

		$filePrincipal = $this->request->getFile('imagen_principal');
		$nombreImagenPrincipal = null;

		if ($filePrincipal->isValid() && !$filePrincipal->hasMoved()) {
			$nombreImagenPrincipal = $filePrincipal->getRandomName();
			$filePrincipal->move($rutaUpload, $nombreImagenPrincipal);
			$imagenesSubidas[] = ['ruta' => 'uploads/productos/' . $nombreImagenPrincipal, 'es_principal' => true];
		}

		for ($i = 1; $i <= 5; $i++) {
			$fileSecundario = $this->request->getFile("imagen_secundaria_{$i}");

			if ($fileSecundario && $fileSecundario->isValid() && !$fileSecundario->hasMoved()) {
				$nombreSecundario = $fileSecundario->getRandomName();
				$fileSecundario->move($rutaUpload, $nombreSecundario);
				$imagenesSubidas[] = ['ruta' => 'uploads/productos/' . $nombreSecundario, 'es_principal' => false];
			}
		}

		$datosProducto = [
			'nombre'        => $this->request->getPost('nombre'),
			'descripcion'   => $this->request->getPost('descripcion'),
			'precio'        => $this->request->getPost('precio'),
			'stock'         => $this->request->getPost('stock'),
			'id_categoria'  => $this->request->getPost('id_categoria'),
			'imagen'        => $imagenesSubidas[0]['ruta'] ?? null,
			'tipo'          => $this->request->getPost('tipo'),
			'activo'        => 1,
		];

		if ($productoModel->insert($datosProducto)) {
			$id_producto = $productoModel->insertID();

			$imagenesGaleria = [];
			$orden = 1;

			foreach ($imagenesSubidas as $img) {
				$imagenesGaleria[] = [
					'id_producto' => $id_producto,
					'ruta_imagen' => $img['ruta'],
					'orden'       => $orden++,
				];
			}

			if (!empty($imagenesGaleria)) {
				$productoImagenModel->insertBatch($imagenesGaleria);
			}

			return redirect()->to(base_url('admin/productos'))->with('success', '✅ Producto creado exitosamente.');
		} else {
			return redirect()->back()->withInput()->with('errors', $productoModel->errors());
		}
	}

	public function editar($id_producto = null)
	{
		helper('form');

		$productoModel = new \App\Models\ProductoModel();
		$productoImagenModel = new \App\Models\ProductoImagenModel();
		$categoriaModel = new \App\Models\CategoriaModel();

		$producto = $productoModel->find($id_producto);

		if (empty($producto)) {
			return redirect()->to(base_url('admin/productos'))->with('error', '❌ Producto no encontrado.');
		}

		$imagenes = $productoImagenModel
			->where('id_producto', $id_producto)
			->orderBy('orden', 'asc')
			->findAll();

		$categorias = $categoriaModel->findAll();

		$data = [
			'title'      => 'Editar Producto: ' . $producto['nombre'],
			'producto'   => $producto,
			'imagenes'   => $imagenes,
			'categorias' => $categorias,
		];

		return $this->loadAdminView('admin/productos/editar', $data);
	}

	public function actualizar($id_producto = null)
	{
		if (!$this->request->is('post') || $id_producto === null) {
			return redirect()->to(base_url('admin/productos'))->with('error', 'Solicitud no válida.');
		}

		helper(['form', 'filesystem']);
		$productoModel = new ProductoModel();
		$productoImagenModel = new ProductoImagenModel();

		$productoActual = $productoModel->find($id_producto);
		if (!$productoActual) {
			return redirect()->to(base_url('admin/productos'))->with('error', 'Producto no encontrado para actualizar.');
		}

		$rules = [
			'nombre'           => 'required|min_length[3]|max_length[150]',
			'descripcion'      => 'permit_empty|string',
			'precio'           => 'required|decimal|greater_than[0]',
			'stock'            => 'required|integer|greater_than_equal_to[0]',
			'id_categoria'     => 'required|integer',
			'tipo'             => 'required|in_list[estandar,personalizable]',
			'imagen_principal' => 'max_size[imagen_principal,2048]|ext_in[imagen_principal,jpg,jpeg,png]',
		];
		for ($i = 1; $i <= 5; $i++) {
			$rules["imagen_secundaria_{$i}"] = 'max_size[imagen_secundaria_' . $i . ',2048]|ext_in[imagen_secundaria_' . $i . ',jpg,jpeg,png]';
		}

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$rutaUpload = ROOTPATH . 'public/uploads/productos/';
		if (!is_dir($rutaUpload)) {
			mkdir($rutaUpload, 0777, true);
		}

		$rutaNuevaPrincipal = $productoActual['imagen'];
		$filePrincipal = $this->request->getFile('imagen_principal');
		$imagenesSecundariasNuevas = [];

		if ($filePrincipal && $filePrincipal->isValid() && !$filePrincipal->hasMoved()) {

			$registroPrincipalAntiguo = $productoImagenModel
				->where('id_producto', $id_producto)
				->where('orden', 1)
				->first();

			if ($registroPrincipalAntiguo) {
				$rutaAntiguaFisica = ROOTPATH . 'public/' . $registroPrincipalAntiguo['ruta_imagen'];
				if (file_exists($rutaAntiguaFisica) && !is_dir($rutaAntiguaFisica)) {
					if (file_exists($rutaAntiguaFisica)) {
						unlink($rutaAntiguaFisica);
					}
				}

				$productoImagenModel->skipValidation(true)->delete($registroPrincipalAntiguo['id']);
			}

			$nombreNuevo = $filePrincipal->getRandomName();
			$filePrincipal->move($rutaUpload, $nombreNuevo);
			$rutaNuevaPrincipal = 'uploads/productos/' . $nombreNuevo;

			$productoImagenModel->insert([
				'id_producto' => $id_producto,
				'ruta_imagen' => $rutaNuevaPrincipal,
				'orden'       => 1,
			]);

			$imagenesExistentes = $productoImagenModel
				->where('id_producto', $id_producto)
				->orderBy('orden', 'asc')
				->findAll();

			$ordenReinicio = 2;
			$batchUpdate = [];
			foreach ($imagenesExistentes as $img) {
				$batchUpdate[] = [
					'id'    => $img['id'],
					'orden' => $ordenReinicio++,
				];
			}

			if (!empty($batchUpdate)) {
				$productoImagenModel->updateBatch($batchUpdate, 'id');
			}
		}

		$ordenActual = $productoImagenModel
			->where('id_producto', $id_producto)
			->selectMax('orden')
			->first()['orden'] ?? 0;

		$orden = $ordenActual + 1;

		$files = $this->request->getFiles();

		for ($i = 1; $i <= 5; $i++) {
			$fileSecundario = $this->request->getFile("imagen_secundaria_{$i}");

			if ($fileSecundario && $fileSecundario->isValid() && !$fileSecundario->hasMoved()) {
				$nombreSecundario = $fileSecundario->getRandomName();
				$fileSecundario->move($rutaUpload, $nombreSecundario);
				$rutaSecundaria = 'uploads/productos/' . $nombreSecundario;

				$imagenesSecundariasNuevas[] = [
					'id_producto' => $id_producto,
					'ruta_imagen' => $rutaSecundaria,
					'orden'       => $orden++,
				];
			}
		}

		if (!empty($imagenesSecundariasNuevas)) {
			$productoImagenModel->insertBatch($imagenesSecundariasNuevas);
		}

		$datosProducto = [
			'nombre'        => $this->request->getPost('nombre'),
			'descripcion'   => $this->request->getPost('descripcion'),
			'precio'        => $this->request->getPost('precio'),
			'stock'         => $this->request->getPost('stock'),
			'id_categoria'  => $this->request->getPost('id_categoria'),
			'tipo'          => $this->request->getPost('tipo'),
			'imagen'        => $rutaNuevaPrincipal,
		];

		$productoModel->update($id_producto, $datosProducto);

		return redirect()->to(base_url('admin/productos'))->with('success', 'Producto actualizado exitosamente.');
	}

	public function eliminarImagenGaleria($id_imagen = null)
	{
		if (!$this->request->isAJAX() || $id_imagen === null) {
			return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Solicitud no válida.']);
		}

		$productoImagenModel = new ProductoImagenModel();
		$imagen = $productoImagenModel->find($id_imagen);

		if (empty($imagen)) {
			return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Imagen no encontrada.']);
		}

		$rutaCompleta = ROOTPATH . 'public/' . $imagen['ruta_imagen'];
		if (file_exists($rutaCompleta)) {
			unlink($rutaCompleta);
		}

		$productoImagenModel->delete($id_imagen);

		return $this->response->setJSON(['success' => true, 'message' => 'Imagen eliminada.']);
	}

	public function eliminarProducto($id_producto = null)
	{
		if (!$id_producto) {
			return redirect()->to(base_url('admin/productos'))->with('error', 'ID de producto no especificado.');
		}

		$productoModel = new  ProductoModel();

		if (!$productoModel->find($id_producto)) {
			return redirect()->to(base_url('admin/productos'))->with('error', 'El producto no existe o ya fue eliminado.');
		}

		$productoModel->delete($id_producto);

		return redirect()->to(base_url('admin/productos'))->with('success', 'Producto eliminado exitosamente.');
	}

	public function categorias()
	{
		helper('form');
		$data['title'] = 'Gestión de Categorías';

		$categoriaModel = new  CategoriaModel();
		$data['categorias'] = $categoriaModel->findAll();

		return $this->loadAdminView('admin/categorias/index', $data);
	}

	public function guardarCategoria()
	{
		helper('url');

		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/categorias'));
		}

		$categoriaModel = new  CategoriaModel();

		if (!$categoriaModel->validate($this->request->getPost())) {
			return redirect()->back()->withInput()->with('errors', $categoriaModel->errors());
		}

		$datosCategoria = [
			'nombre' => $this->request->getPost('nombre'),
			'descripcion' => $this->request->getPost('descripcion'),
			'tipo' => 'general'
		];

		$categoriaModel->insert($datosCategoria);

		return redirect()->to(base_url('admin/categorias'))->with('success', 'Categoría creada exitosamente.');
	}

	public function carrusel()
	{
		helper('form');

		// Lógica para obtener las imágenes activas del carrusel, ordenadas por el campo 'orden'
		// $carruselModel = new  CarruselModel();
		// $data['imagenes'] = $carruselModel->orderBy('orden', 'asc')->findAll();

		$data['imagenes'] = (object)[
			(object)['id' => 3, 'nombre_archivo' => 'img_03.jpg', 'orden' => 1],
			(object)['id' => 1, 'nombre_archivo' => 'img_01.jpg', 'orden' => 2],
			(object)['id' => 2, 'nombre_archivo' => 'img_02.jpg', 'orden' => 3],
		];

		$data['title'] = 'Gestión de Carrusel Principal';

		return $this->loadAdminView('admin/carrusel/index', $data);
	}

	public function subirCarrusel()
	{
		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/carrusel'));
		}

		helper(['form', 'filesystem']);

		$rules = [
			'imagen_carrusel' => 'uploaded[imagen_carrusel]|max_size[imagen_carrusel,2048]|ext_in[imagen_carrusel,jpg,jpeg,png]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('error', $this->validator->getError('imagen_carrusel'));
		}

		$file = $this->request->getFile('imagen_carrusel');
		$rutaUpload = WRITEPATH . 'uploads/carrusel/';

		if ($file->isValid() && !$file->hasMoved()) {
			$nuevoNombre = $file->getRandomName();
			$file->move($rutaUpload, $nuevoNombre);

			// 3. Guardar en la DB (Obtener el siguiente valor de 'orden')
			// $carruselModel = new  CarruselModel();
			// $carruselModel->insert([
			//     'nombre_archivo' => $nuevoNombre,
			//     'orden' => $carruselModel->getSiguienteOrden(), // Necesitas esta lógica en el modelo
			// ]);

			return redirect()->to(base_url('admin/carrusel'))->with('success', 'Imagen subida exitosamente.');
		}

		return redirect()->back()->with('error', 'Error al procesar la imagen.');
	}

	private function loadAdminView($contentView, $data = [])
	{
		$html = view('admin/layout/header', $data);
		$html .= view('admin/layout/sidebar', $data);
		$html .= view($contentView, $data);
		$html .= view('admin/layout/footer', $data);

		return $html;
	}
}
