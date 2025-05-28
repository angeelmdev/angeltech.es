import { Component } from '@angular/core';
import { NavbarComponent } from './components/navbar/navbar.component';
import { ProjectButtonComponent } from './components/project-button/project-button.component';
import { PresentationBoxComponent } from "./components/presentation-box/presentation-box.component";
import { ProjectsBoxComponent } from './components/projects-box/projects-box.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [NavbarComponent, ProjectButtonComponent, PresentationBoxComponent,  ProjectsBoxComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {
  title = 'angeltech.es';
}
