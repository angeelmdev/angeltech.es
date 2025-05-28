import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectButtonComponent } from './project-button.component';

describe('ProjectButtonComponent', () => {
  let component: ProjectButtonComponent;
  let fixture: ComponentFixture<ProjectButtonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProjectButtonComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProjectButtonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
