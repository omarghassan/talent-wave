<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Talent Wave Sidebar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Replace icon font with inline SVG icons for better compatibility -->
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
      overflow-x: hidden;
    }

    .wrapper {
      display: flex;
      position: relative;
    }

    .sidenav {
      width: 260px;
      height: 100vh;
      background-color: #ffffff;
      /* Changed to white */
      position: fixed;
      left: 0;
      top: 0;
      overflow-y: auto;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      z-index: 1000;
    }

    .main-content {
      margin-left: 260px;
      width: calc(100% - 260px);
      padding: 20px;
      min-height: 100vh;
    }

    .sidenav-header {
      padding: 20px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      /* Changed border color for white background */
      margin-bottom: 10px;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #333;
      /* Changed text color for white background */
    }

    .navbar-brand-img {
      margin-right: 12px;
    }

    .navbar-brand span {
      font-size: 16px;
      font-weight: 500;
      color: #333;
      /* Changed text color for white background */
    }

    .navbar-nav {
      list-style: none;
      padding: 0;
      margin: 0;
      flex: 1;
    }

    .nav-item {
      margin: 6px 0;
    }

    .nav-link {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #333;
      /* Changed text color for white background */
      padding: 14px 20px;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      background-color: #E05F00;
      color: #fff;
    }

    .nav-link.active {
      background-color: #E05F00;
      color: #fff;
    }

    .icon {
      width: 20px;
      height: 20px;
      margin-right: 15px;
      fill: currentColor;
    }

    /* Logout section styling */
    .logout-section {
      margin-top: auto;
      padding-bottom: 20px;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
      /* Changed for white background */
      margin-top: 20px;
      padding-top: 10px;
    }

    .logout-button {
      display: flex;
      align-items: center;
      color: #333;
      /* Changed text color for white background */
      padding: 14px 20px;
      border: none;
      background-color: transparent;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      text-align: left;
      font-family: inherit;
      font-size: 14px;
    }

    .logout-button:hover {
      background-color: #E05F00;
      color: #fff;
    }

    .navbar-collapse {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    /* Sample content styling */
    .content-card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
    }

    /* SVG Icons */
    .nav-icon {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-right: 15px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidenav">
      <div class="sidenav-header">
        <a class="navbar-brand" href="{{route('dashboard')}}">
          <img src="{{asset('../assets/img/title.png')}}" class="navbar-brand-img" width="30" height="30" alt="Talent Wave Logo">
          <span>Talent Wave</span>
        </a>
      </div>

      <div class="navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path>
              </svg>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('profile.index')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
              </svg>
              <span>Profile</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('attendances.index')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39-2.57 0-4.66 1.97-4.66 4.39 0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94 1.7 0 3.08 1.32 3.08 2.94 0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z"></path>
              </svg>
              <span>Attendances</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('leaves.index')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"></path>
              </svg>
              <span>Leaves</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('docs.index')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
              </svg>
              <span>Documents</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('tickets.index')}}">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M22 10V6c0-1.11-.9-2-2-2H4c-1.1 0-1.99.89-1.99 2v4c1.1 0 1.99.9 1.99 2s-.89 2-2 2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-4c-1.1 0-2-.9-2-2s.9-2 2-2zm-2-1.46c-1.19.69-2 1.99-2 3.46s.81 2.77 2 3.46V18H4v-2.54c1.19-.69 2-1.99 2-3.46 0-1.48-.8-2.77-1.99-3.46L4 6h16v2.54z"></path>
                <path fill="currentColor" d="M11 15h2v2h-2zm0-8h2v6h-2z"></path>
              </svg>
              <span>Tickets</span>
            </a>
          </li>
        </ul>

        <div class="logout-section">
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
              <svg class="nav-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"></path>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </aside>
  </div>
</body>

</html>