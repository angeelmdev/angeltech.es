import { Component } from '@angular/core';
import { AuthService } from '../../../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar-panel',
  standalone: true,
  imports: [],
  templateUrl: './navbar-panel.component.html',
  styleUrl: './navbar-panel.component.css'
})
export class NavbarPanelComponent {

  constructor(private authService: AuthService, private router: Router) { }

  logout() {
    this.authService.deleteAuth();
    this.router.navigate(['/login']);
  }
}
