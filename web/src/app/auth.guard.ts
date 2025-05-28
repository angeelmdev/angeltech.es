import { Injectable } from '@angular/core';
import { ActivatedRoute, CanActivate } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
    
@Injectable({
  providedIn: 'root'
})
  export class AuthGuard implements CanActivate {

    constructor(private cookieService: CookieService, private router: Router, private activatedRoute: ActivatedRoute) { }
    
    canActivate(): boolean {
      const cookie = this.cookieService.get('token');

      if (!cookie) {
          this.router.navigate(['/login']);
          return false;
      } else {
        return true;
      }
    }  

}