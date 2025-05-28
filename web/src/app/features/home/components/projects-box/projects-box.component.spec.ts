import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectsBoxComponent } from './projects-box.component';

describe('ProjectBoxComponent', () => {
  let component: ProjectsBoxComponent;
  let fixture: ComponentFixture<ProjectsBoxComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProjectsBoxComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ProjectsBoxComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
