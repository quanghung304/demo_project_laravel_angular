import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CheckinCalendarComponent } from './modules/checkin_calendar/checkin-calendar/checkin-calendar.component';
import { CheckinFormComponent } from './modules/checkin_calendar/checkin-form/checkin-form.component';
import { EmployeeFormComponent } from './modules/employee/employee-form/employee-form.component';
import { EmployeeComponent } from './modules/employee/employee/employee.component';
import { SalaryFormComponent } from './modules/salary_report/salary-form/salary-form.component';
import { SalaryReportComponent } from './modules/salary_report/salary-report/salary-report.component';

const routes: Routes = [
  {path: '', redirectTo: '/employees', pathMatch: 'full'},
  {path: 'employees', component: EmployeeComponent},
  {path: 'employees/add', component: EmployeeFormComponent},
  {path: 'employees/:id', component: EmployeeFormComponent},
  {path: 'checkin_calendar/:id', component: CheckinCalendarComponent},
  {path: 'checkin_form', component: CheckinFormComponent},
  {path: 'salary_reports', component: SalaryReportComponent},
  {path: 'salary_reports/:id', component: SalaryReportComponent},
  {path: 'salary_form', component: SalaryFormComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
