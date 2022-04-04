import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { EmployeeServiceService } from '../../../service/employee.service';
import { Router } from '@angular/router';
import { departments } from '../../../model/departments';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-employee-form',
  templateUrl: './employee-form.component.html',
  styleUrls: ['./employee-form.component.css']
})
export class EmployeeFormComponent implements OnInit {
  update = false; 
  submited: any;
  departments = departments;
  error: any

  constructor(
    private employeeService: EmployeeServiceService,
    private route: Router,
    private aRoute: ActivatedRoute
  ) {}
  
  employeeFormGroup = new FormGroup({
    fullName: new FormControl('', Validators.required),
    employee_id: new FormControl('', Validators.required),
    email: new FormControl('', Validators.email),
    phone_number:new FormControl(''),
    department_id:new FormControl('', Validators.required),
    basic_salary: new FormControl('', Validators.required),
    lunch_allowance:new FormControl(''),
    other_allowance: new FormControl(''),
    insurance_rate: new FormControl(''),
    dependents_number: new FormControl(''),
  });

  ngOnInit(): void {
    this.submited = false
    this.error = null
    this.aRoute.paramMap.subscribe(params => {
      const employeeId = params.get('id');
      console.log(employeeId);
      if (employeeId) {
        this.update = true;
        this.getEmployee(employeeId);
      }
    })
  }

  getEmployee(id: string): void {
    this.employeeService.getAnEmployee(id).subscribe(
      rsc => {
        this.editEmployee(rsc['employee']);
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
  editEmployee(employee: any){
    console.log(employee);
    console.log(employee['fullName']);
    this.employeeFormGroup.setValue({
      fullName: employee.fullName,
      employee_id: employee.employee_id,
      email: employee.email,
      phone_number: employee.phone_number,
      department_id: employee.department_id,
      basic_salary: employee.basic_salary,
      lunch_allowance: employee.lunch_allowance,
      other_allowance: employee.other_allowance,
      insurance_rate: employee.insurance_rate,
      dependents_number: employee.dependents_number,
    })
  }

  saveEmployee() {
    this.submited = true;
    if(!this.update) {
    this.employeeService.saveEmployee(this.employeeFormGroup.value).subscribe(
      () => {
        alert('Thêm thành công!')
        this.route.navigate(['/employees'])
      }, 
      (error) => {
        if(error.status == 404) {
          alert('Ma nhan vien da ton tai')
        } else {
          alert('Some field are missing')
        }
      }
      )
    } else {
      this.employeeService.updateEmployee(this.employeeFormGroup.value).subscribe(
        () => {
          alert('Thay đổi thông tin thành công!')
          this.route.navigate(['/employees'])
        }
      )
    }
  }
}
