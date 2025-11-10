<?php

namespace App\Repositories\Dashboard;

use App\Models\Page;

class PageRepository
{
    public function getPages()
    {
        return Page::latest()->get();
    }

    public function getPage($id)
    {
        return Page::find($id);
    }

    public function createPage($data)
    {
        return Page::create($data);
    }

    public function updatePage($page, $data)
    {
        return $page->update($data);
    }

    public function deletePage($page)
    {
        return $page->delete();
    }
}
