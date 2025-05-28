import { Injectable } from '@angular/core';
import { Login } from '../interfaces/login';
import {CookieService} from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private apiUrl: string = 'http://localhost:8000/api/login_check';

  constructor(private http: HttpClient, private cookieService: CookieService, private router: Router) { }

  getAuth(login: Login) {
    this.http.post<{ token: string }>(this.apiUrl, login).subscribe({
      next: response => { 
        console.log('Login successful:', response.token);
        this.cookieService.set('token', response.token, 1);
        this.router.navigate(['/panel']);
      },
      error: error => { 
        console.error('Login failed:', error);
      },
    });
  }

  deleteAuth() {
    this.cookieService.delete('token');
    this.router.navigate(['/login']);
  }
}
