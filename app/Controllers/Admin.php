<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

		$productoModel = new \App\Models\ProductoModel();

		$data['productos'] = $productoModel->getProductosConCategoria();

		return $this->loadAdminView('admin/productos/index', $data);
	}

	public function crearProducto()
	{
		helper('form');
		$data['title'] = 'Crear Nuevo Producto';

		$categoriaModel = new \App\Models\CategoriaModel();

		$data['categorias'] = $categoriaModel->findAll();

		return $this->loadAdminView('admin/productos/crear', $data);
	}

	public function crear_guardar()
	{
		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/productos/crear'));
		}

		helper(['form', 'filesystem']);
		$productoModel = new \App\Models\productoModel();

		$rules = [
			'nombre'        => 'required|min_length[3]|max_length[150]',
			'descripcion'   => 'permit_empty|string',
			'precio'        => 'required|decimal|greater_than[0]',
			'stock'         => 'required|integer|greater_than_equal_to[0]',
			'id_categoria'  => 'required|integer',
			'imagenes'      => 'uploaded[imagenes]|max_size[imagenes,2048]|ext_in[imagenes,jpg,jpeg,png]',
			'tipo'          => 'required|in_list[estandar,personalizable]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$files = $this->request->getFiles();
		$nombreImagen = null;
		$rutaUpload = ROOTPATH . 'public/uploads/productos/';
		$productoModel = new \App\Models\productoModel();

		if (!is_dir($rutaUpload)) {
			mkdir($rutaUpload, 0777, true);
		}

		if (isset($files['imagenes'])) {

			$file = $files['imagenes'][0];

			if ($file->isValid() && !$file->hasMoved()) {
				$nombreImagen = $file->getRandomName();
				$file->move($rutaUpload, $nombreImagen);
			}
		}

		$datosProducto = [
			'nombre'        => $this->request->getPost('nombre'),
			'descripcion'   => $this->request->getPost('descripcion'),
			'precio'        => $this->request->getPost('precio'),
			'stock'         => $this->request->getPost('stock'),
			'id_categoria'  => $this->request->getPost('id_categoria'),
			'imagen'        => 'uploads/productos/' . $nombreImagen,
			'tipo'          => $this->request->getPost('tipo'),
			'activo'        => 1,
		];

		$productoModel->insert($datosProducto);

		return redirect()->to(base_url('admin/productos'))->with('success', 'Producto creado exitosamente.');
	}

	public function eliminarProducto($id_producto = null)
	{
		if (!$id_producto) {
			return redirect()->to(base_url('admin/productos'))->with('error', 'ID de producto no especificado.');
		}

		$productoModel = new \App\Models\ProductoModel();

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

		$categoriaModel = new \App\Models\CategoriaModel();
		$data['categorias'] = $categoriaModel->findAll();

		return $this->loadAdminView('admin/categorias/index', $data);
	}

	public function guardarCategoria()
	{
		helper('url');

		if (!$this->request->is('post')) {
			return redirect()->to(base_url('admin/categorias'));
		}

		$categoriaModel = new \App\Models\CategoriaModel();

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
		// $carruselModel = new \App\Models\CarruselModel();
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
			// $carruselModel = new \App\Models\CarruselModel();
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
