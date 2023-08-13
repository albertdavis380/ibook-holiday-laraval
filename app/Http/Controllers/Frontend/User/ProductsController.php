<?php

namespace App\Http\Controllers\Frontend\User;

/**
 * Class ProductsController   .
 */
class ProductsController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.user.products');
    }
}
