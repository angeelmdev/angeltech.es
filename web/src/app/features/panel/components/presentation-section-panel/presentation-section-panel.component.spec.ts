import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PresentationSectionPanelComponent } from './presentation-section-panel.component';

describe('PresentationSectionPanelComponent', () => {
  let component: PresentationSectionPanelComponent;
  let fixture: ComponentFixture<PresentationSectionPanelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [PresentationSectionPanelComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PresentationSectionPanelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
