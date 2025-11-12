<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\ProductoImagenModel;
use App\Models\CategoriaModel;
use App\Models\carruselProductoModel;
use App\Models\BannerModel;

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

		$productoModel = new ProductoModel();
		$productoImagenModel = new ProductoImagenModel();
		$categoriaModel = new CategoriaModel();

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
			'imagen_principal' => 'if_exist|max_size[imagen_principal,2048]|ext_in[imagen_principal,jpg,jpeg,png]',
		];
		for ($i = 1; $i <= 5; $i++) {
			$rules["imagen_secundaria_{$i}"] = 'if_exist|max_size[imagen_secundaria_' . $i . ',2048]|ext_in[imagen_secundaria_' . $i . ',jpg,jpeg,png]';
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
		$nuevasSecundarias = false;

		if ($filePrincipal && $filePrincipal->isValid() && !$filePrincipal->hasMoved()) {

			$registroPrincipalAntiguo = $productoImagenModel
				->where('id_producto', $id_producto)
				->where('orden', 1)
				->first();

			if ($registroPrincipalAntiguo) {
				$rutaAntiguaFisica = ROOTPATH . 'public/' . $registroPrincipalAntiguo['ruta_imagen'];
				if (file_exists($rutaAntiguaFisica)) {
					unlink($rutaAntiguaFisica);
				}
				$productoImagenModel->delete($registroPrincipalAntiguo['id']);
			}

			$nombreNuevo = $filePrincipal->getRandomName();
			$filePrincipal->move($rutaUpload, $nombreNuevo);
			$rutaNuevaPrincipal = 'uploads/productos/' . $nombreNuevo;

			$productoImagenModel->insert([
				'id_producto' => $id_producto,
				'ruta_imagen' => $rutaNuevaPrincipal,
				'orden'       => 1,
			]);
		}

		$imagenesSecundarias = $this->request->getFiles();

		if (isset($imagenesSecundarias['imagen_secundaria']) && is_array($imagenesSecundarias['imagen_secundaria'])) {
			foreach ($imagenesSecundarias['imagen_secundaria'] as $orden => $fileSecundario) {
				if ($fileSecundario instanceof \CodeIgniter\HTTP\Files\UploadedFile && $fileSecundario->isValid() && !$fileSecundario->hasMoved()) {

					$imgExistente = $productoImagenModel
						->where('id_producto', $id_producto)
						->where('orden', $orden)
						->first();

					if ($imgExistente) {
						$rutaFisica = ROOTPATH . 'public/' . $imgExistente['ruta_imagen'];
						if (file_exists($rutaFisica)) unlink($rutaFisica);
						$productoImagenModel->delete($imgExistente['id']);
					}

					$nombreSecundario = $fileSecundario->getRandomName();
					$fileSecundario->move($rutaUpload, $nombreSecundario);
					$rutaSecundaria = 'uploads/productos/' . $nombreSecundario;

					$productoImagenModel->insert([
						'id_producto' => $id_producto,
						'ruta_imagen' => $rutaSecundaria,
						'orden'       => $orden,
					]);
				}
			}
		}

		if ($nuevasSecundarias) {
			$imagenesAntiguas = $productoImagenModel
				->where('id_producto', $id_producto)
				->where('orden >', 1)
				->findAll();

			foreach ($imagenesAntiguas as $img) {
				$rutaFisica = ROOTPATH . 'public/' . $img['ruta_imagen'];
				if (file_exists($rutaFisica)) {
					unlink($rutaFisica);
				}
				$productoImagenModel->delete($img['id']);
			}

			$orden = 2;
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

		if ($this->request->isAJAX()) {
			return $this->response->setJSON([
				'success' => true,
				'message' => 'Producto actualizado correctamente'
			]);
		}

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
		$method = strtolower($this->request->getMethod() ?? '');
		$override = strtolower($this->request->getPost('_method') ?? '');

		if ($method !== 'post' && $method !== 'delete' && $override !== 'delete') {
			if ($this->request->isAJAX()) {
				return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Método no permitido.']);
			}
			return redirect()->to(base_url('admin/productos'))->with('error', 'Método no permitido.');
		}

		if ($id_producto === null) {
			if ($this->request->isAJAX()) {
				return $this->response->setJSON(['success' => false, 'message' => 'ID de producto no especificado.']);
			}
			return redirect()->to(base_url('admin/productos'))->with('error', 'ID de producto no especificado.');
		}

		$productoModel = new ProductoModel();
		$productoImagenModel = new ProductoImagenModel();

		$producto = $productoModel->find($id_producto);
		if (!$producto) {
			if ($this->request->isAJAX()) {
				return $this->response->setJSON(['success' => false, 'message' => 'El producto no existe o ya fue eliminado.']);
			}
			return redirect()->to(base_url('admin/productos'))->with('error', 'El producto no existe o ya fue eliminado.');
		}

		try {
			$imagenes = $productoImagenModel->where('id_producto', $id_producto)->findAll();
			foreach ($imagenes as $img) {
				$rutaCompleta = ROOTPATH . 'public/' . $img['ruta_imagen'];
				if (file_exists($rutaCompleta) && is_file($rutaCompleta)) {
					@unlink($rutaCompleta);
				}
				$productoImagenModel->delete($img['id']);
			}

			if (!empty($producto['imagen'])) {
				$rutaPrincipal = ROOTPATH . 'public/' . $producto['imagen'];
				if (file_exists($rutaPrincipal) && is_file($rutaPrincipal)) {
					@unlink($rutaPrincipal);
				}
			}

			$productoModel->delete($id_producto);

			if ($this->request->isAJAX()) {
				return $this->response->setJSON(['success' => true, 'message' => 'Producto eliminado correctamente.']);
			}

			return redirect()->to(base_url('admin/productos'))->with('success', 'Producto eliminado correctamente.');
		} catch (\Exception $e) {
			if ($this->request->isAJAX()) {
				return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error al eliminar: ' . $e->getMessage()]);
			}
			return redirect()->to(base_url('admin/productos'))->with('error', 'Error al eliminar el producto.');
		}
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
		];

		$categoriaModel->insert($datosCategoria);

		return redirect()->to(base_url('admin/categorias'))->with('success', 'Categoría creada exitosamente.');
	}

	public function editarCategoria($id_categoria)
	{
		$categoriaModel = new categoriaModel();

		$data = [
			'nombre' => $this->request->getPost('nombre'),
			'descripcion' => $this->request->getPost('descripcion')
		];

		$rules = [
			'nombre' => "required|min_length[3]|max_length[100]|is_unique[categorias.nombre,id_categoria,{$id_categoria}]",
			'descripcion' => 'permit_empty|string|max_length[255]'
		];

		if (! $this->validate($rules)) {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'Error de validación',
				'errors' => $this->validator->getErrors()
			]);
		}

		if ($categoriaModel->update($id_categoria, $data)) {
			return $this->response->setJSON([
				'success' => true,
				'message' => 'Categoría actualizada correctamente'
			]);
		} else {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'No se pudo actualizar la categoría.'
			]);
		}
	}

	public function eliminarCategoria($id_categoria = null)
	{
		$method = strtolower($this->request->getMethod() ?? '');
		$override = strtolower($this->request->getPost('_method') ?? '');

		if ($method !== 'post' && $method !== 'delete' && $override !== 'delete') {
			if ($this->request->isAJAX()) {
				return $this->response->setStatusCode(405)->setJSON([
					'success' => false,
					'message' => 'Método no permitido.'
				]);
			}
			return redirect()->to(base_url('admin/categorias'))->with('error', 'Método no permitido.');
		}

		if ($id_categoria === null) {
			return $this->response->setStatusCode(400)->setJSON([
				'success' => false,
				'message' => 'ID de categoría no especificado.'
			]);
		}

		$categoriaModel = new CategoriaModel();
		$productoModel = new ProductoModel();

		$categoria = $categoriaModel->find($id_categoria);
		if (!$categoria) {
			return $this->response->setStatusCode(404)->setJSON([
				'success' => false,
				'message' => 'Categoría no encontrada.'
			]);
		}

		$productos = $productoModel->where('id_categoria', $id_categoria)->countAllResults();
		if ($productos > 0) {
			return $this->response->setStatusCode(400)->setJSON([
				'success' => false,
				'message' => '⚠️ No se puede eliminar la categoría porque tiene productos asociados.'
			]);
		}

		$categoriaModel->delete($id_categoria);

		if ($this->request->isAJAX()) {
			return $this->response->setJSON([
				'success' => true,
				'message' => '✅ Categoría eliminada correctamente.'
			]);
		}

		return redirect()->to(base_url('admin/categorias'))->with('success', '✅ Categoría eliminada correctamente.');
	}

	public function carruselesProductos()
	{
		helper('form');
		$carruselModel = new CarruselProductoModel();
		$categoriaModel = new CategoriaModel();

		$categorias = $categoriaModel->findAll();

		$configuraciones = $carruselModel
			->select('carrusel_productos.*, categorias.nombre AS nombre_categoria')
			->join('categorias', 'categorias.id_categoria = carrusel_productos.id_categoria', 'left')
			->orderBy('orden', 'asc')
			->findAll();

		$maxOrden = $carruselModel->selectMax('orden')->first()['orden'] ?? 0;

		$data = [
			'title'           => 'Gestión de Carruseles de Productos',
			'configuraciones' => $configuraciones,
			'categorias'      => $categorias,
			'siguiente_orden' => $maxOrden + 1,
		];

		return $this->loadAdminView('admin/carrusel/productos_index', $data);
	}

	public function guardarCarruselProducto()
	{
		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/carrusel/productos'));
		}

		$carruselModel = new CarruselProductoModel();

		$rules = [
			'titulo'       => 'required|max_length[100]',
			'id_categoria' => 'required|integer',
			'tipo'         => 'permit_empty|in_list[estandar,personalizable]',
			'orden'        => 'required|integer|greater_than_equal_to[1]',
			'limite'       => 'required|integer|greater_than_equal_to[1]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$data = [
			'titulo'       => $this->request->getPost('titulo'),
			'id_categoria' => $this->request->getPost('id_categoria'),
			'tipo'         => $this->request->getPost('tipo') ?? null,
			'orden'        => $this->request->getPost('orden'),
			'limite'       => $this->request->getPost('limite'),
		];

		$carruselModel->insert($data);

		return redirect()->to(base_url('admin/carrusel/productos'))->with('success', '✅ Carrusel configurado correctamente.');
	}

	public function eliminarCarruselProductos($id = null)
	{
		if ($id === null) {
			return $this->response->setJSON(['success' => false, 'message' => 'ID de carrusel no especificado.']);
		}

		$carruselModel = new CarruselProductoModel();

		if ($carruselModel->delete($id)) {
			return $this->response->setJSON(['success' => true, 'message' => 'Carrusel eliminado.']);
		} else {
			return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'No se pudo eliminar el carrusel (posible error de clave foránea).']);
		}
	}

	public function carrusel()
	{
		helper('form');
		$bannerModel = new BannerModel();

		$data['imagenes'] = $bannerModel->orderBy('orden', 'asc')->findAll();
		$data['title'] = 'Gestión de Carrusel Banners';

		return $this->loadAdminView('admin/carrusel/index', $data);
	}

	public function subirCarrusel()
	{
		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/carrusel'));
		}
		helper(['form', 'filesystem']);
		$bannerModel = new BannerModel();

		$rules = [
			'imagen_banner' => 'uploaded[imagen_banner]|max_size[imagen_banner,3072]|ext_in[imagen_banner,jpg,jpeg,png]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$file = $this->request->getFile('imagen_banner');
		$rutaUpload = ROOTPATH . 'public/uploads/banners/';

		if (!is_dir($rutaUpload)) {
			mkdir($rutaUpload, 0777, true);
		}

		if ($file->isValid() && !$file->hasMoved()) {
			$nuevoNombre = $file->getRandomName();
			$file->move($rutaUpload, $nuevoNombre);
			$rutaDB = 'uploads/banners/' . $nuevoNombre;

			$maxOrden = $bannerModel->selectMax('orden')->first()['orden'] ?? 0;

			$bannerModel->insert([
				'ruta_imagen' => $rutaDB,
				'orden' => $maxOrden + 1,
			]);

			return redirect()->to(base_url('admin/carrusel'))->with('success', 'Banner subido exitosamente.');
		}

		return redirect()->back()->with('error', 'Error al procesar el banner.');
	}

	public function eliminarCarrusel($id_banner = null)
	{
		if (!$this->request->isAJAX() || $id_banner === null) {
			return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Solicitud no válida.']);
		}

		$bannerModel = new bannerModel();
		$banner = $bannerModel->find($id_banner);

		if (empty($banner)) {
			return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Banner no encontrado.']);
		}

		$rutaCompleta = ROOTPATH . 'public/' . $banner['ruta_imagen'];
		$archivoEliminado = true;

		if (file_exists($rutaCompleta) && is_file($rutaCompleta)) {
			if (!@unlink($rutaCompleta)) {
				$archivoEliminado = false;
				log_message('error', 'Permiso denegado: Falló la eliminación física del banner: ' . $rutaCompleta);
			}
		}

		$dbEliminado = $bannerModel->delete($id_banner);


		if ($dbEliminado) {
			return $this->response->setJSON(['success' => true, 'message' => 'Banner eliminado correctamente.']);
		} else {
			return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error de Base de Datos: El registro no pudo ser eliminado.']);
		}
	}

	private function loadAdminView($view, $data = [])
	{
		if (!isset($data) || !is_array($data)) {
			$data = [];
		}
		$html = view('admin/layout/header', $data);
		$html .= view('admin/layout/sidebar', $data);
		$html .= view($view, $data);
		$html .= view('admin/layout/footer', $data);

		return $html;
	}
}
