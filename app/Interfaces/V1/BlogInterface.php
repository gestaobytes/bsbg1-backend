<?php

namespace App\Interfaces\v1;

use Illuminate\Http\Request;

interface BlogInterface {
    public function index();
    public function comboBox();
    public function show(int $id);
    public function details(int $id);
    public function store(Request $request);
    public function update(int $id, Request $request);
    public function delete(int $id);
    public function trash();
    public function restore(int $id);
}