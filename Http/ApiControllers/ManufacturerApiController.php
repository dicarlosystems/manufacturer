<?php

namespace Modules\Manufacturer\Http\ApiControllers;

use App\Http\Controllers\BaseAPIController;
use Modules\Manufacturer\Repositories\ManufacturerRepository;
use Modules\Manufacturer\Http\Requests\ManufacturerRequest;
use Modules\Manufacturer\Http\Requests\CreateManufacturerRequest;
use Modules\Manufacturer\Http\Requests\UpdateManufacturerRequest;

class ManufacturerApiController extends BaseAPIController
{
    protected $ManufacturerRepo;
    protected $entityType = 'manufacturer';

    public function __construct(ManufacturerRepository $manufacturerRepo)
    {
        parent::__construct();

        $this->manufacturerRepo = $manufacturerRepo;
    }

    /**
     * @SWG\Get(
     *   path="/manufacturer",
     *   summary="List manufacturer",
     *   operationId="listManufacturers",
     *   tags={"manufacturer"},
     *   @SWG\Response(
     *     response=200,
     *     description="A list of manufacturer",
     *      @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Manufacturer"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function index()
    {
        $data = $this->manufacturerRepo->all();

        return $this->listResponse($data);
    }

    /**
     * @SWG\Get(
     *   path="/manufacturer/{manufacturer_id}",
     *   summary="Individual Manufacturer",
     *   operationId="getManufacturer",
     *   tags={"manufacturer"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="manufacturer_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="A single manufacturer",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Manufacturer"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function show(ManufacturerRequest $request)
    {
        return $this->itemResponse($request->entity());
    }




    /**
     * @SWG\Post(
     *   path="/manufacturer",
     *   summary="Create a manufacturer",
     *   operationId="createManufacturer",
     *   tags={"manufacturer"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="manufacturer",
     *     @SWG\Schema(ref="#/definitions/Manufacturer")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="New manufacturer",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Manufacturer"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function store(CreateManufacturerRequest $request)
    {
        $manufacturer = $this->manufacturerRepo->save($request->input());

        return $this->itemResponse($manufacturer);
    }

    /**
     * @SWG\Put(
     *   path="/manufacturer/{manufacturer_id}",
     *   summary="Update a manufacturer",
     *   operationId="updateManufacturer",
     *   tags={"manufacturer"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="manufacturer_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     in="body",
     *     name="manufacturer",
     *     @SWG\Schema(ref="#/definitions/Manufacturer")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Updated manufacturer",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Manufacturer"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function update(UpdateManufacturerRequest $request, $publicId)
    {
        if ($request->action) {
            return $this->handleAction($request);
        }

        $manufacturer = $this->manufacturerRepo->save($request->input(), $request->entity());

        return $this->itemResponse($manufacturer);
    }


    /**
     * @SWG\Delete(
     *   path="/manufacturer/{manufacturer_id}",
     *   summary="Delete a manufacturer",
     *   operationId="deleteManufacturer",
     *   tags={"manufacturer"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="manufacturer_id",
     *     type="integer",
     *     required=true
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Deleted manufacturer",
     *      @SWG\Schema(type="object", @SWG\Items(ref="#/definitions/Manufacturer"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function destroy(UpdateManufacturerRequest $request)
    {
        $manufacturer = $request->entity();

        $this->manufacturerRepo->delete($manufacturer);

        return $this->itemResponse($manufacturer);
    }

}
