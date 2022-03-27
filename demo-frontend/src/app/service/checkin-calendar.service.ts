import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { CheckinCalendar } from '../model/checkin-calendar';

@Injectable({
  providedIn: 'root'
})

export class CheckinCalendarService {
  checkinUrl = environment.host + '/api/checkin_calendar';

  constructor(private http: HttpClient) { }

  getCheckinRecord(): Observable<CheckinCalendar[]> {
    return this.http.get<CheckinCalendar[]>(this.checkinUrl);
  }
  
  getCheckinCalById(id: string): Observable<CheckinCalendar[]> {
    const url = `${this.checkinUrl}/${id}`;
    return this.http.get<CheckinCalendar[]>(url);
  }

  submitCheckinForm(newCheckinInfo: CheckinCalendar): Observable<CheckinCalendar> {
    return this.http.post<CheckinCalendar>(this.checkinUrl, newCheckinInfo);
  }
}
