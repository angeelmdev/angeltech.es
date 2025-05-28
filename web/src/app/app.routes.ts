import { Routes } from '@angular/router';
import { HomeComponent } from './features/home/home.component';
import { LoginComponent } from './features/login/login.component';
import { PanelComponent } from './features/panel/panel.component';
import { AuthGuard } from './auth.guard';

export const routes: Routes = [
    { 
        path: '',
        component: HomeComponent,
        title: 'Porfolio'
    },
    { 
        path: 'login',
        component: LoginComponent,
        title: 'Iniciar sesión'
    },
    { 
        path: 'panel',
        component: PanelComponent,
        canActivate: [AuthGuard],
        title: 'Panel de control'
    },
];
