import { Component, OnInit } from '@angular/core';
import { SalaryReportService } from '../../../service/salary-report.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-salary-report',
  templateUrl: './salary-report.component.html',
  styleUrls: ['./salary-report.component.css']
})
export class SalaryReportComponent implements OnInit {
  salaryReports: any;
  
  displayedColumns: string[] = ['month', 'employee_id', 'ngay_cong_chuan', 'ngay_cong_OT', 'cong_tac_phi', 
                                'thuong', 'phut_di_muon', 'khoan_tru_khac', 'ngay_cong_tinh_luong', 'luong_theo_ngay_cong',
                                'luong_OT', 'phu_cap_khac', 'tru_di_muon', 'phu_cap_an_trua', 'bao_hiem', 'tong_thu_nhap',
                                'tien_an_duoc_mien_thue', 'luong_OT_duoc_mien_thue', 'giam_tru_gia_canh', 'thu_nhap_tinh_thue',
                                'thue_TNCN', 'luong_thuc_nhan', 'link'];

  constructor(
    private salaryReportService: SalaryReportService,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      const employeeId = params.get('id');
      console.log(employeeId);
      if (employeeId) {
        this.getSalaryReport();
      } else {
        this.getAllSalReport();
      }
    })
  }

  getAllSalReport(): void {
    this.salaryReports = this.salaryReportService.getAllSalReport().subscribe(
      salaryReport => this.salaryReports = salaryReport
    )
  }
  getSalaryReport(): void {
    const id = this.route.snapshot.paramMap.get('id');
    console.log(`this.route.snapshot.paramMap = ${JSON.stringify(this.route.snapshot.paramMap)}`);
    this.salaryReports = this.salaryReportService.getSalaryReportById(id!).subscribe(
      salaryReport => this.salaryReports = salaryReport
    );
  }
}
