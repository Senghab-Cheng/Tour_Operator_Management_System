<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - AdvanTo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom scrollbar to match the clean UI */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-6">
            <div>
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3 px-2 mb-8">
                    <div class="bg-cyan-500 text-white p-2 rounded-xl">
                        <i class="fa-solid fa-plane-departure text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-slate-800 tracking-tight">AdvanTo</span>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-1.5">
                    <!-- Home (Dashboard) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl bg-cyan-500 text-white transition-all duration-200">
                        <i class="fa-solid fa-chart-pie text-lg"></i>
                        <span>Home</span>
                    </a>

                    <!-- About -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all duration-200">
                        <i class="fa-solid fa-address-card text-lg"></i>
                        <span>About</span>
                    </a>

                    <!-- Service -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all duration-200">
                        <i class="fa-solid fa-hand-holding-heart text-lg"></i>
                        <span>Service</span>
                    </a>

                    <!-- Tour -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all duration-200">
                        <i class="fa-solid fa-map-location-dot text-lg"></i>
                        <span>Tour</span>
                    </a>

                    <!-- Guide -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all duration-200">
                        <i class="fa-solid fa-user-tie text-lg"></i>
                        <span>Guide</span>
                    </a>

                    <!-- Contact -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all duration-200">
                        <i class="fa-solid fa-envelope text-lg"></i>
                        <span>Contact</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Action: Logout -->
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-rose-500 hover:bg-rose-50 rounded-xl transition-all duration-200 text-left">
                        <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            
            <!-- TOP NAVBAR -->
            <header class="bg-white border-b border-slate-100 h-16 flex items-center justify-between px-8 sticky top-0 z-10">
                <!-- Search Bar -->
                <div class="relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Search places..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:bg-white transition-all">
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-all">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-cyan-500 rounded-full"></span>
                    </button>

                    <!-- Staff User Profile -->
                    <div class="flex items-center gap-3 border-l border-slate-100 pl-4">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name ?? 'Staff Member' }}</p>
                            <p class="text-xs text-cyan-600 font-medium">Staff Account</p>
                        </div>
                        <img class="w-10 h-10 rounded-xl object-cover bg-slate-100" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Avatar">
                    </div>
                </div>
            </header>

            <!-- DASHBOARD CONTAINER -->
            <div class="p-8 max-w-7xl w-full mx-auto space-y-8">
                
                <!-- Welcome/Header Block -->
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
                    <p class="text-slate-500 text-sm">Welcome back! Here's what's happening today.</p>
                </div>

                <!-- STATS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <!-- Stat 1 -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Total Visits</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-1">240</h3>
                        </div>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i> 2.5%
                        </span>
                    </div>

                    <!-- Stat 2 -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Cancel Travel</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-1">15</h3>
                        </div>
                        <span class="bg-rose-50 text-rose-600 text-xs font-semibold px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-down"></i> 1.5%
                        </span>
                    </div>

                    <!-- Stat 3 -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">In Queue</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-1">24</h3>
                        </div>
                        <span class="bg-cyan-50 text-cyan-600 text-xs font-semibold px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i> 1.8%
                        </span>
                    </div>

                    <!-- Stat 4 -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">Interested Places</p>
                            <h3 class="text-2xl font-bold text-slate-800 mt-1">56</h3>
                        </div>
                        <span class="bg-cyan-50 text-cyan-600 text-xs font-semibold px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i> 3.0%
                        </span>
                    </div>
                </div>

                <!-- MAIN DISPLAY (Double Columns) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left: Content Panels -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-800 mb-4">Trending Places</h3>
                            <!-- Placeholder content area -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="border border-dashed border-slate-200 rounded-xl p-6 text-center text-slate-400">
                                    Place Slot 1
                                </div>
                                <div class="border border-dashed border-slate-200 rounded-xl p-6 text-center text-slate-400">
                                    Place Slot 2
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Quick Info / Calendar -->
                    <div class="space-y-8">
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-800 mb-4">Upcoming Visitors</h3>
                            <!-- Placeholder List -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100"></div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-800">Don Norman</h4>
                                        <p class="text-xs text-slate-400">05 Oct, 2026</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

</body>
</html>