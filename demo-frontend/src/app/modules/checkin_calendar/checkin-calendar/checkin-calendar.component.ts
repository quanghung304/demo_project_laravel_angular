import { Component, OnInit } from '@angular/core';
import { CheckinCalendarService } from '../../../service/checkin-calendar.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-checkin-calendar',
  templateUrl: './checkin-calendar.component.html',
  styleUrls: ['./checkin-calendar.component.css']
})
export class CheckinCalendarComponent implements OnInit {
  checkinCalendars: any;
  displayedColumns: string[] = [
    'month', 'employee_id', 'cong_theo_thang', 'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 
  ];

  constructor(
    private checkinCalService: CheckinCalendarService,
    private route: ActivatedRoute
    ) { }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      const employeeId = params.get('id');
      console.log(employeeId);
      if (employeeId) {
        this.getCheckinCalById();
      } else {
        this.getAllCheckinRecord();
      }
    })
  }

  getAllCheckinRecord(): void {
    this.checkinCalendars = this.checkinCalService.getCheckinRecord().subscribe(
      checkinCalendar => this.checkinCalendars = checkinCalendar
    )
  }

  getCheckinCalById(): void {
    const id = this.route.snapshot.paramMap.get('id');
    console.log(`this.route.snapshot.paramMap = ${JSON.stringify(this.route.snapshot.paramMap)}`);
    this.checkinCalendars = this.checkinCalService.getCheckinCalById(id!).subscribe(
      checkinCalendar => this.checkinCalendars = checkinCalendar
    );
  }
}
