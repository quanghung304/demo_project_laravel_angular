import { Component, OnInit } from '@angular/core';
import { SalaryReportService } from '../service/salary-report.service';
import { FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-salary-form',
  templateUrl: './salary-form.component.html',
  styleUrls: ['./salary-form.component.css']
})

export class SalaryFormComponent implements OnInit {
  submitted=false;
  
  constructor(
    private salaryReportService: SalaryReportService,
    private route: Router,
  ) { }

  
  salaryReportFormGroup = new FormGroup({
    thang: new FormControl(''),
    employee_id: new FormControl(''),
    ngay_cong_chuan: new FormControl(''),
    ngay_cong_OT: new FormControl(''),
    cong_tac_phi: new FormControl(''),
    thuong: new FormControl(''),
    phut_di_muon: new FormControl(''),
    khoan_tru_khac: new FormControl('')
  });

  ngOnInit(): void {
  }

  saveSalaryReport() {
    this.salaryReportService.submitSalaryInfo(this.salaryReportFormGroup.value).subscribe(
      () => {
        this.route.navigate([`/salary_reports/${this.salaryReportFormGroup.value.employee_id}`]);
        console.log(`/salary_reports/${this.salaryReportFormGroup.value.employee_id}`)
      }
    )
  }
}
