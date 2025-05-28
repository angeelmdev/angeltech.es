import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-project-button',
  standalone: true,
  imports: [],
  templateUrl: './project-button.component.html',
  styleUrl: './project-button.component.css'
})
export class ProjectButtonComponent {
  @Input() projectName = '';
  @Input() projectDescription = '';
  @Input() projectUrl = '';
  @Input() isAngular = false;
  @Input() isSymfony = false;
  @Input() isNode = false;
  @Input() isBootstrap = false;

  redirectToProject() {
    window.location.href = this.projectUrl;
  }
}
