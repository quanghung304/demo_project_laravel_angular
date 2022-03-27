import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { SalaryReport } from '../model/salary-report';

@Injectable({
  providedIn: 'root'
})
export class SalaryReportService {
  salaryReportUrl = environment.host + '/api/salary_reports';
  
  constructor(private http: HttpClient) { }
  
  getAllSalReport(): Observable<SalaryReport[]> {
    return this.http.get<SalaryReport[]>(this.salaryReportUrl);
  }

  getSalaryReportById(id: string): Observable<SalaryReport[]> {
    const url = `${this.salaryReportUrl}/${id}`;
    return this.http.get<SalaryReport[]>(url);
  }
  
  submitSalaryInfo(newSalReplort: SalaryReport): Observable<SalaryReport> {
    return this.http.post<SalaryReport>(this.salaryReportUrl, newSalReplort);
  }
}
