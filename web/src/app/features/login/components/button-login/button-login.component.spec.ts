import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ButtonLoginComponent } from './button-login.component';

describe('ButtonLoginComponent', () => {
  let component: ButtonLoginComponent;
  let fixture: ComponentFixture<ButtonLoginComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ButtonLoginComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ButtonLoginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
