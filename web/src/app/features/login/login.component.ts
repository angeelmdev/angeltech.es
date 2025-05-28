import { JsonPipe } from '@angular/common';
import { Component, signal } from '@angular/core';
import { ReactiveFormsModule, FormGroup, FormControl, Validators } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Login } from '../../interfaces/login';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule, JsonPipe],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {

  constructor(private authService: AuthService, private router: Router) {}

  form = signal<FormGroup>(
    new FormGroup(
      {
        email: new FormControl('', [Validators.required, Validators.email]),
        password: new FormControl('', [Validators.required]),
      }
    )
  );

  login() {
    if (this.form().valid) {
      const loginData = this.form().value as Login;
      this.authService.getAuth(loginData);
    } else {
      console.warn('Formulario no válido');
    }
  }

}
