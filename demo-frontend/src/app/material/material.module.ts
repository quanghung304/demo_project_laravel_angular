import { NgModule } from '@angular/core';
import { MatButtonModule} from '@angular/material/button';
import { MatTableModule} from '@angular/material/table';

const MaterialComponent = [
  MatButtonModule,
  MatTableModule
]

@NgModule({
  imports: [MaterialComponent],
  exports: [MaterialComponent]
})
export class MaterialModule { }
