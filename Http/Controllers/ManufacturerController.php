<?php

namespace Modules\Manufacturer\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Services\DatatableService;
use Modules\Manufacturer\Datatables\ManufacturerDatatable;
use Modules\Manufacturer\Repositories\ManufacturerRepository;
use Modules\Manufacturer\Http\Requests\ManufacturerRequest;
use Modules\Manufacturer\Http\Requests\CreateManufacturerRequest;
use Modules\Manufacturer\Http\Requests\UpdateManufacturerRequest;

class ManufacturerController extends BaseController
{
    protected $ManufacturerRepo;
    //protected $entityType = 'manufacturer';

    public function __construct(ManufacturerRepository $manufacturerRepo)
    {
        //parent::__construct();

        $this->manufacturerRepo = $manufacturerRepo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('list_wrapper', [
            'entityType' => 'manufacturer',
            'datatable' => new ManufacturerDatatable(),
            'title' => mtrans('manufacturer', 'manufacturer_list'),
        ]);
    }

    public function datatable(DatatableService $datatableService)
    {
        $search = request()->input('sSearch');
        $userId = Auth::user()->filterId();

        $datatable = new ManufacturerDatatable();
        $query = $this->manufacturerRepo->find($search, $userId);

        return $datatableService->createDatatable($datatable, $query);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ManufacturerRequest $request)
    {
        $data = [
            'manufacturer' => null,
            'method' => 'POST',
            'url' => 'manufacturer',
            'title' => mtrans('manufacturer', 'new_manufacturer'),
        ];

        return view('manufacturer::edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateManufacturerRequest $request)
    {
        $manufacturer = $this->manufacturerRepo->save($request->input());

        return redirect()->to($manufacturer->present()->editUrl)
            ->with('message', mtrans('manufacturer', 'created_manufacturer'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(ManufacturerRequest $request)
    {
        $manufacturer = $request->entity();

        $data = [
            'manufacturer' => $manufacturer,
            'method' => 'PUT',
            'url' => 'manufacturer/' . $manufacturer->public_id,
            'title' => mtrans('manufacturer', 'edit_manufacturer'),
        ];

        return view('manufacturer::edit', $data);
    }

    /**
     * Show the form for editing a resource.
     * @return Response
     */
    public function show(ManufacturerRequest $request)
    {
        return redirect()->to("manufacturer/{$request->manufacturer}/edit");
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateManufacturerRequest $request)
    {
        $manufacturer = $this->manufacturerRepo->save($request->input(), $request->entity());

        return redirect()->to($manufacturer->present()->editUrl)
            ->with('message', mtrans('manufacturer', 'updated_manufacturer'));
    }

    /**
     * Update multiple resources
     */
    public function bulk()
    {
        $action = request()->input('action');
        $ids = request()->input('public_id') ?: request()->input('ids');
        $count = $this->manufacturerRepo->bulk($ids, $action);

        return redirect()->to('manufacturer')
            ->with('message', mtrans('manufacturer', $action . '_manufacturer_complete'));
    }
}
