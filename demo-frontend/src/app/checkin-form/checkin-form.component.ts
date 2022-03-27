import { Component, OnInit } from '@angular/core';
import { CheckinCalendarService } from '../service/checkin-calendar.service';
import { FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-checkin-form',
  templateUrl: './checkin-form.component.html',
  styleUrls: ['./checkin-form.component.css']
})
export class CheckinFormComponent implements OnInit {

  constructor(
    private checkinService: CheckinCalendarService,
    private route: Router
  ) { }

  checkinFormGroup = new FormGroup({
    thang: new FormControl(''),
    employee_id: new FormControl(''),
    day_1: new FormControl(''),
    day_2: new FormControl(''),
    day_3: new FormControl(''),
    day_4: new FormControl(''),
    day_5: new FormControl(''),
    day_6: new FormControl(''),
    day_7: new FormControl(''),
    day_8: new FormControl(''),
    day_9: new FormControl(''),
    day_10: new FormControl(''),
    day_11: new FormControl(''),
    day_12: new FormControl(''),
    day_13: new FormControl(''),
    day_14: new FormControl(''),
    day_15: new FormControl(''),
    day_16: new FormControl(''),
    day_17: new FormControl(''),
    day_18: new FormControl(''),
    day_19: new FormControl(''),
    day_20: new FormControl(''),
    day_21: new FormControl(''),
    day_22: new FormControl(''),
    day_23: new FormControl(''),
    day_24: new FormControl(''),
    day_25: new FormControl(''),
    day_26: new FormControl(''),
    day_27: new FormControl(''),
    day_28: new FormControl(''),
    day_29: new FormControl(''),
    day_30: new FormControl(''),
    day_31: new FormControl(''),
  });

  ngOnInit(): void {
  }
  
  saveCheckinForm(){
      this.checkinService.submitCheckinForm(this.checkinFormGroup.value).subscribe(
        () => this.route.navigate(['/salary_form'])
      )
  }
}
