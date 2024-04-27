<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use App\View\Helper\ToolsHelper;
use Cake\View\View;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 */
class GalleriesController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('AdminPanel.Albums');
        $this->loadModel('AdminPanel.Images');
        $this->loadModel('AdminPanel.Galleries');
    }


    public function index($albumId = null)
    {
        $this->viewBuilder()->setLayout('pages');
    
        $toolsHelper = new ToolsHelper(new View());
        $this->set('toolsHelper', $toolsHelper);
    
        // Ambil semua album
        $albums = $this->Albums->find()->all()->toArray();
    
        // Buat kondisi untuk filter berdasarkan album yang dipilih
        $conditions = [];
        if ($albumId) {
            $conditions['Galleries.album_id'] = $albumId;
        }
    
        // Query galeri dengan kondisi yang telah ditentukan
        $galleryQuery = $this->Galleries->find()
            ->contain([
                'Albums',
                'Images'
            ])
            ->where($conditions)
            ->orderDesc('Galleries.id');
    
        // Paginasi hasil query
        $galleries = $this->paginate($galleryQuery, ['limit' => 6])->map(function (\AdminPanel\Model\Entity\Gallery $row) {
            $path = explode('/', $row->image->dir);
            unset($path[0]);
            $path = implode('/', $path);
            $row->image->dir = $path;
    
            $row->title = $row->title ?? 'Yo Check This Out';
    
            return $row;
        })->toArray();
    
        // Kirim data ke tampilan
        $this->set(compact('galleries', 'albums', 'albumId'));
    }
  // Tambahkan method baru untuk mengambil data galeri berdasarkan kategori album yang dipilih
  public function filterGalleryAjax($albumId) {
    $this->autoRender = false; // Tidak perlu melakukan render tampilan
    $this->viewBuilder()->setLayout(false); // Tidak perlu layout

    // Ambil nomor halaman dan jumlah item per halaman dari permintaan AJAX
    $page = $this->request->getQuery('page') ?: 1;
    $limit = $this->request->getQuery('limit') ?: 6;

    // Hitung offset berdasarkan nomor halaman
    $offset = ($page - 1) * $limit;

    // Query galeri dengan kondisi yang telah ditentukan dan lakukan paginasi
    $galleryQuery = $this->Galleries->find()
        ->contain([
            'Albums',
            'Images'
        ])
        ->where(['Galleries.album_id' => $albumId])
        ->orderDesc('Galleries.id')
        ->offset($offset)
        ->limit($limit);

    // Ambil jumlah total galeri untuk paginasi
    $totalGalleries = $galleryQuery->count();

    // Kirim data dalam format JSON
    echo json_encode([
        'galleries' => $galleryQuery->toArray(),
        'total' => $totalGalleries,
        'page' => $page,
        'limit' => $limit
    ]);
}



}