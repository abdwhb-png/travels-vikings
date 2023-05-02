<template>
    <main>
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="navbar-brand brand-logo-mini" href="/"><span class="h3" style="font-family:'Poppins',sans-serif; color:#f8f9fa">TRAVELS VIKINGS</span></a>
            </div>
            <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                    <i class="mdi mdi-account-circle fs-1"></i>
                    <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                    <h5 class="mb-0 font-weight-normal">{{user.username}}</h5>
                    <span>Registration date : <br> {{ member.created_at.replace('.000000Z', ' ').replace('T', ' ')}}</span> <br>
                    <span>Phone : {{ member.phone}}</span>
                    </div>
                </div>
                 <a href="#" id="profile-dropdown" @click.prevent="toggleProfileDropD1 = !toggleProfileDropD1" data-bs-toggle="dropdown" :aria-expanded="toggleProfileDropD1"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" :class="toggleProfileDropD1?'show':''" aria-labelledby="profile-dropdown">
                    <a href="/member/account-settings" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-primary"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                    </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/change-password" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-onepassword  text-info"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                    </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
                    </div>
                    </a>
                </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/member/dashboard">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/member/journey">
                <span class="menu-icon">
                    <i class="mdi mdi-rocket"></i>
                </span>
                <span class="menu-title">My Journey</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/member/fund-info">
                <span class="menu-icon">
                    <i class="mdi mdi-wallet"></i>
                </span>
                <span class="menu-title">Fund Info</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/contact">
                <span class="menu-icon">
                    <i class="mdi mdi-headset"></i>
                </span>
                <span class="menu-title">Contact Info</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/about">
                <span class="menu-icon">
                    <i class="mdi mdi-help-circle"></i>
                </span>
                <span class="menu-title">About Us</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="/tcs">
                <span class="menu-icon">
                    <i class="mdi mdi-help-circle"></i>
                </span>
                <span class="menu-title">Tc&Cs</span>
                </a>
            </li>
            <!-- <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#members" aria-expanded="false" aria-controls="members">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Members</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="members">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/admin/members/list">Members List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/members/grades">Members Grades</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/members/connection-logs">Connection Logs</a></li>
                </ul>
                </div>
            </li> -->
            </ul>
        </nav>
    </main>
</template>

<script>
import { ref } from 'vue'
export default {
    props:{
        user:{
            type: Object,
            required: true,
        },
        member:{
            type: Object,
            required: true,
        }
    },
      setup() {
         const currentUrl = window.location.pathname
        return {
          currentUrl
        }
      },
      data() {
        return {
          toggleProfileDropD1: ref(false),
        }
      },
}
</script>
