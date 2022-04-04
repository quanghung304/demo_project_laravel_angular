import { Component, OnInit } from '@angular/core';
import { SalaryReportService } from '../../../service/salary-report.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { EmployeeServiceService } from '../../../service/employee.service';

@Component({
  selector: 'app-salary-form',
  templateUrl: './salary-form.component.html',
  styleUrls: ['./salary-form.component.css']
})

export class SalaryFormComponent implements OnInit {
  employees: any
  submited: any
  error: any
  constructor(
    private salaryReportService: SalaryReportService,
    private route: Router,
    private employeeService: EmployeeServiceService
  ) { }

  
  salaryReportFormGroup = new FormGroup({
    month: new FormControl('', Validators.required),
    employee_id: new FormControl('', Validators.required),
    ngay_cong_chuan: new FormControl('', Validators.required),
    ngay_cong_OT: new FormControl(''),
    cong_tac_phi: new FormControl(''),
    thuong: new FormControl(''),
    phut_di_muon: new FormControl(''),
    khoan_tru_khac: new FormControl('')
  });

  ngOnInit(): void {
    this.submited = false
    this.error = null
    this.getEmployees()
  }

  getEmployees() {
    this.employees = this.employeeService.getEmployee().subscribe(
      employee => this.employees = employee
    )
  }

  saveSalaryReport() {
    this.submited = true
    this.salaryReportService.submitSalaryInfo(this.salaryReportFormGroup.value).subscribe(
      () => {
        this.route.navigate([`/salary_reports/${this.salaryReportFormGroup.value.employee_id}`]);
        console.log(`/salary_reports/${this.salaryReportFormGroup.value.employee_id}`)
      },
      (error) => {
          alert('Ban ghi da ton tai')
      }
    )
  }
}
