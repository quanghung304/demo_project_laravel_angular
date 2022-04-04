import { Component, OnInit } from '@angular/core';
import { Employee } from '../../../model/Employee';
import { EmployeeServiceService } from '../../../service/employee.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.css']
})

export class EmployeeComponent implements OnInit {
  employees: any;
  displayedColumns: string[] = ['fullName', 'employee_id', 'department_id', 'basic_salary', 'lunch_allowance', 
                                'other_allowance', 'insurance_rate', 'dependents_number', 'link','edit', 'delete'];

  constructor(
    private employeeService: EmployeeServiceService,
    private route: Router
    ) { }

  ngOnInit(): void {
    this.getEmployees();
  }

  getEmployees(): void {
    this.employees = this.employeeService.getEmployee().subscribe(
      employee => this.employees = employee
    );
  }

  goToEdit(id: string): void {
    this.route.navigate([`/employees/${id}`])
  }

  updateEmployee(employee: Employee): void {
    this.employeeService.updateEmployee(employee).subscribe(
      () => {
        alert(`Thay đổi thông tin nhân viên có mã số  ${employee.employee_id}`)
        window.location.reload()
      }
    )
  }
  
  deleteEmployee(employeeID: string): void {
    this.employeeService.deleteEmployee(employeeID).subscribe(
      () => {
        alert(`Xóa thành công nhân viên có mã số  ${employeeID}`);
        window.location.reload()
      }
    )
  }
}
