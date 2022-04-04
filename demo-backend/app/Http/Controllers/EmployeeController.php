<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employeeRepo;

    /**
     * @param $employeeRepo
     */
    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function getAllEmmployee()
    {
        return $this->employeeRepo->getAll();
    }

    public function getAnEmployee($id)
    {
        $employee = $this->employeeRepo->getEmployeeById($id);

        return response()->json(['employee' => $employee], 201);
    }

    public function addEmployee(Request $request)
    {
        if ($this->employeeRepo->checkExistById($request->input('employee_id'))) {
            return response()->json(['message' => "Record  has been exist"], 404);
        } else {
            $employee = $this->employeeRepo->insert($request);
        }

        return response()->json(['employee' => $employee], 201);
    }

    public function updateEmployee(Request $request)
    {
        $employee = $this->employeeRepo->update($request);

        return response()->json(['employee' => $employee], 201);
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeRepo->delete($id);

        return response()->json(['employee' => 'Employee deleted'], 200);
    }
}
