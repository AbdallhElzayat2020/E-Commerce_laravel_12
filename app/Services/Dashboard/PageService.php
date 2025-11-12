<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use App\Utils\ImageManager;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PageService
{
    protected $pageRepository, $imageManager;

    public function __construct(PageRepository $pageRepository, ImageManager $imageManager)
    {
        $this->pageRepository = $pageRepository;
        $this->imageManager = $imageManager;
    }

    public function getPages()
    {
        return $this->pageRepository->getPages();
    }

    public function getPagesForDataTables()
    {
        $pages = $this->getPages();

        return DataTables::of($pages)
            ->addIndexColumn()
            ->addColumn('title', function ($page) {
                return $page->getTranslation('title', app()->getLocale());
            })
            ->addColumn('content', function ($page) {
                return view('dashboard.pages.pages.dataTables.content', compact('page'))->render();
            })
            ->addColumn('image', function ($page) {
                return $page->image != null ? view('dashboard.pages.pages.dataTables.image', compact('page'))->render() : __('dashboard.no_image');
            })
            ->addColumn('action', function ($page) {
                return view('dashboard.pages.pages.dataTables.actions', compact('page'))->render();
            })
            ->rawColumns(['action', 'image', 'content'])
            ->make(true);
    }


    public function getPage($id)
    {
        return $this->pageRepository->getPage($id);
    }

    public function createPage($data)
    {
        if (array_key_exists('image', $data) && $data['image'] != null) {
            $image_name = $this->imageManager->uploadSingleFile('/', $data['image'], 'pages');
            $data['image'] = $image_name;
        }

        $data['slug'] = Str::slug($data['title']['en']);
        return $this->pageRepository->createPage($data);
    }

    public function updatePage($data, $id)
    {
        $page = $this->getPage($id);
        if (array_key_exists('image', $data) && $data['image'] != null) {
            $this->imageManager->deleteImageLocal('uploads/pages/' . $page->image);
            $image_name = $this->imageManager->uploadSingleFile('/', $data['image'], 'pages');
            $data['image'] = $image_name;
        }
        $data['slug'] = Str::slug($data['title']['en']);
        return $this->pageRepository->updatePage($page, $data);
    }

    public function deletePage($id)
    {
        if (!$page = $this->getPage($id)) {
            return false;
        }
        if ($page->image != null) {
            $this->imageManager->deleteImageLocal('uploads/pages/' . $page->image);
        }
        return $this->pageRepository->deletePage($page);
    }
}
