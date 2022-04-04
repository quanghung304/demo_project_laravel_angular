import { NgModule } from '@angular/core';
import { MatButtonModule} from '@angular/material/button';
import { MatTableModule} from '@angular/material/table';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';
import { MatFormFieldModule } from '@angular/material/form-field';

const MaterialComponent = [
  MatButtonModule,
  MatTableModule,
  MatDatepickerModule,
  MatNativeDateModule,
  MatFormFieldModule
]

@NgModule({
  imports: [MaterialComponent],
  exports: [MaterialComponent]
})
export class MaterialModule { }
