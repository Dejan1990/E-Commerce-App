<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\DB;

class SettingController extends BaseController
{
    public function index()
    {
        $this->setPagetitle('Settings', 'Manage Setting');
        return view('admin.settings.index');
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }
}
