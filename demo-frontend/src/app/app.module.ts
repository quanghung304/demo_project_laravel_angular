import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { EmployeeComponent } from './modules/employee/employee/employee.component';
import { EmployeeFormComponent } from './modules/employee/employee-form/employee-form.component';
import { EmployeeServiceService } from './service/employee.service';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material/material.module';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { SalaryReportComponent } from './modules/salary_report/salary-report/salary-report.component';
import { SalaryFormComponent } from './modules/salary_report/salary-form/salary-form.component';
import { CheckinCalendarComponent } from './modules/checkin_calendar/checkin-calendar/checkin-calendar.component';
import { CheckinFormComponent } from './modules/checkin_calendar/checkin-form/checkin-form.component';
import { MonthPickerComponent } from './shared/month-picker/month-picker.component';

@NgModule({
  declarations: [
    AppComponent,
    EmployeeComponent,
    EmployeeFormComponent,
    SalaryReportComponent,
    SalaryFormComponent,
    CheckinCalendarComponent,
    CheckinFormComponent,
    MonthPickerComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule
  ],
  providers: [
    EmployeeServiceService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
