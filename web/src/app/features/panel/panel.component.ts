import { Component } from '@angular/core';
import { NavbarPanelComponent } from "./components/navbar-panel/navbar-panel.component";
import { PresentationSectionPanelComponent } from "./components/presentation-section-panel/presentation-section-panel.component";
import { ProjectsSectionPanelComponent } from "./components/projects-section-panel/projects-section-panel.component";

@Component({
  selector: 'app-panel',
  standalone: true,
  imports: [NavbarPanelComponent, PresentationSectionPanelComponent, ProjectsSectionPanelComponent],
  templateUrl: './panel.component.html',
  styleUrl: './panel.component.css'
})
export class PanelComponent {

}
