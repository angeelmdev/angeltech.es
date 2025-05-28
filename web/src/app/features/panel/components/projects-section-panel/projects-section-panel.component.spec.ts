import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectsSectionPanelComponent } from './projects-section-panel.component';

describe('ProjectsSectionPanelComponent', () => {
  let component: ProjectsSectionPanelComponent;
  let fixture: ComponentFixture<ProjectsSectionPanelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProjectsSectionPanelComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProjectsSectionPanelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
