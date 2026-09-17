<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoRequest;
use App\Models\Info;
use App\Services\InfoService;

class InfoController extends Controller
{
    public function __construct(protected InfoService $infoService) {}

    public function index()
    {
        return view('admin.info.index', ['infos' => $this->infoService->getInfos()]);
    }

    public function create()
    {
        return view('admin.info.form', ['info' => new Info(['status' => true, 'sort_order' => 0, 'icon' => 'la-book-open']), 'icons' => Info::ICONS]);
    }

    public function store(InfoRequest $request)
    {
        $this->infoService->saveInfo($request->validated());

        return redirect()->route('admin.info.index')->with('success', 'Info card created successfully.');
    }

    public function edit($id)
    {
        return view('admin.info.form', ['info' => $this->infoService->getInfo($id), 'icons' => Info::ICONS]);
    }

    public function update(InfoRequest $request, $id)
    {
        $this->infoService->updateInfo($id, $request->validated());

        return redirect()->route('admin.info.index')->with('success', 'Info card updated successfully.');
    }

    public function destroy($id)
    {
        $this->infoService->deleteInfo($id);

        return redirect()->route('admin.info.index')->with('success', 'Info card deleted successfully.');
    }
}
