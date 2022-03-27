import { Component, OnInit } from '@angular/core';
import { CheckinCalendarService } from '../service/checkin-calendar.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-checkin-calendar',
  templateUrl: './checkin-calendar.component.html',
  styleUrls: ['./checkin-calendar.component.css']
})
export class CheckinCalendarComponent implements OnInit {
  checkinCalendars: any;
  displayedColumns: string[] = [
    'thang', 'employee_id', 'cong_theo_thang',
    'day_1', 'day_2','day_3','day_4','day_5','day_6','day_7','day_8','day_9',
    'day_10', 'day_11',  'day_12', 'day_13', 'day_14', 'day_15', 'day_16', 'day_17', 'day_18', 'day_19',
    'day_20', 'day_21', 'day_22', 'day_23', 'day_24', 'day_25', 'day_26', 'day_27', 'day_28', 'day_29',
    'day_30', 'day_31'
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
