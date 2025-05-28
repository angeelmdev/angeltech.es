import { Component } from '@angular/core';
import { ProjectButtonComponent } from "../project-button/project-button.component";

@Component({
  selector: 'app-projects-box',
  standalone: true,
  imports: [ProjectButtonComponent],
  templateUrl: './projects-box.component.html',
  styleUrl: './projects-box.component.css'
})
export class ProjectsBoxComponent {
  projects = [
    {
      id: 1,
      name: 'Proyecto 1',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      url: 'https://youtu.be/dQw4w9WgXcQ?si=7OkXzapOXVZB_3AA',
      isAngular: false,
      isSymfony: true,
      isNode: true,
      isBootstrap: true
    },
    {
      id: 2,
      name: 'Proyecto 2',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      url: 'https://youtu.be/hvL1339luv0?si=XrQn0NN8g5avoXlO',
      isAngular: true,
      isSymfony: false,
      isNode: true,
      isBootstrap: true
    },
    {
      id: 3,
      name: 'Proyecto 3',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      url: 'https://youtu.be/nrsnN23tmUA?si=EXsUccS3991WVSUG',
      isAngular: true,
      isSymfony: true,
      isNode: false,
      isBootstrap: true
    },
  ]
}
