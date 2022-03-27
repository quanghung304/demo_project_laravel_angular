import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { EmployeeServiceService } from '../service/employee.service';
import { Router } from '@angular/router';
import { departments } from '../model/departments';
import { ActivatedRoute } from '@angular/router';
import { Employee } from '../model/Employee';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-employee-form',
  templateUrl: './employee-form.component.html',
  styleUrls: ['./employee-form.component.css']
})
export class EmployeeFormComponent implements OnInit {
  employee: any; 
  departments = departments;

  constructor(
    private employeeService: EmployeeServiceService,
    private route: Router,
    private aRoute: ActivatedRoute
  ) {}
  
  employeeFormGroup = new FormGroup({
    fullName: new FormControl(''),
    employee_id: new FormControl(''),
    email: new FormControl(''),
    phone_number:new FormControl(''),
    department_id:new FormControl(''),
    basic_salary: new FormControl(''),
    lunch_allowance:new FormControl(''),
    other_allowance: new FormControl(''),
    insurance_rate: new FormControl(''),
    dependents_number: new FormControl(''),
  });

  ngOnInit(): void {
    this.aRoute.paramMap.subscribe(params => {
      const employeeId = params.get('id');
      console.log(employeeId);
      if (employeeId) {
        this.getEmployee(employeeId);
      }
    })
  }

  getEmployee(id: string): void {
    this.employee = this.employeeService.getAnEmployee(id).subscribe(
      employee => {
        this.editEmployee(employee)
      }
    );
  }
  // getCheckinCalById(): void {
  //   const id = this.route.snapshot.paramMap.get('id');
  //   console.log(`this.route.snapshot.paramMap = ${JSON.stringify(this.route.snapshot.paramMap)}`);
  //   this.checkinCalendars = this.checkinCalService.getCheckinCalById(id!).subscribe(
  //     checkinCalendar => this.checkinCalendars = checkinCalendar
  //   );
  // }
  editEmployee(employee: Employee){
    console.log(employee);
    console.log(employee.fullName);
    this.employeeFormGroup.setValue({
      fullName: this.employee.fullName,
      employee_id: this.employee.employee_id,
      email: this.employee.email,
      phone_number: this.employee.phone_number,
      department_id: this.employee.department_id,
      basic_salary: this.employee.basic_salary,
      lunch_allowance: this.employee.lunch_allowance,
      other_allowance: this.employee.other_allowance,
      insurance_rate: this.employee.insurance_rate,
      dependents_number: this.employee.dependents_number,
    })
  }

  saveEmployee() {
    this.employeeService.saveEmployee(this.employeeFormGroup.value).subscribe(
      () => {
        alert('Thêm thành công!')
        this.route.navigate(['/employees'])
      }
    )
  }
}
