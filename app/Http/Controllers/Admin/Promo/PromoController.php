<?php

namespace App\Http\Controllers\Admin\Promo;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PromoController extends Table
{
    public $deleted_names = 'name';
    public $deleted_specific = 'promos with color';

    public function builder()
    {
        return Promo::query();
    }

    public function index()
    {
        $promos = Promo::latest('updated_at')->get();

        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        User::canTakeAction(User::canCreate);

        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedPromoData($request);

        $promo = Promo::create($data);

        Cache::forget('global_promo');
        (new Activity)->put("Created homepage welcome promo {$promo->title}", null);

        return redirect('admin/promos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        User::canTakeAction(User::canUpdate);
        $promo = Promo::findOrFail($id);

        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);
        $promo->update($this->validatedPromoData($request));

        Cache::forget('global_promo');
        (new Activity)->put("Updated homepage welcome promo {$promo->title}", null);

        return redirect('admin/promos');
    }

    protected function validatedPromoData(Request $request): array
    {
        $validated = $request->validate([
            'background_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'text_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'title' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:500'],
            'cta_text' => ['nullable', 'string', 'max:60'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'coupon_percent' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        return [
            'bgcolor' => $validated['background_color'],
            'text_color' => $validated['text_color'],
            'accent_color' => $validated['accent_color'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'cta_text' => $validated['cta_text'] ?: 'CREATE ACCOUNT',
            'cta_url' => $validated['cta_url'] ?: '/register',
            'coupon_percent' => (int) $validated['coupon_percent'],
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
