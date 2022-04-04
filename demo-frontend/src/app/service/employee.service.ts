import { Injectable } from '@angular/core';
import { Employee } from '../model/Employee';
import { environment } from 'src/environments/environment';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, of } from 'rxjs';

const httpOptions = {
  headers: new HttpHeaders({'Content-Type': 'application/json'})
};

@Injectable({
  providedIn: 'root'
})
export class EmployeeServiceService {
  employeeUrl = environment.host + '/api/employees';

  constructor(private http: HttpClient) { }
  
  getEmployee(): Observable<Employee[]> {
    return this.http.get<Employee[]>(this.employeeUrl);
  }
  
  getAnEmployee(id: string): Observable<any> {
    const url = `${this.employeeUrl}/${id}`;
    return this.http.get<any>(url)
  }

  saveEmployee(newEmployee: Employee): Observable<Employee> {
    return this.http.post<Employee>(this.employeeUrl, newEmployee);
  }

  updateEmployee(employee: Employee): Observable<any> {
    return this.http.put(this.employeeUrl, employee, httpOptions);
  }
  
  deleteEmployee(employeeId: string): Observable<Employee> {
    const url = `${this.employeeUrl}/${employeeId}`;
    return this.http.delete<Employee>(url, httpOptions);
  }
}
