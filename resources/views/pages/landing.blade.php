<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Lumen Generation - Learning Management System</title>
     <script src="https://cdn.tailwindcss.com"></script>

     <style>
          @keyframes fadeIn {
               from {
                    opacity: 0;
               }

               to {
                    opacity: 1;
               }
          }

          @keyframes float {

               0%,
               100% {
                    transform: translateY(-50%) translateX(0);
               }

               50% {
                    transform: translateY(-55%) translateX(0);
               }
          }

          .fade-in {
               animation: fadeIn 1s ease-out;
          }

          .float {
               animation: float 6s ease-in-out infinite;
          }

          .text-shadow {
               text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.15);
          }
     </style>
</head>

<body class="bg-gray-50">

     <!-- Hero Section -->
     <section
          class="min-h-screen relative overflow-hidden flex items-center"
          style="background: linear-gradient(135deg, #3b82f6, #6366f1, #8b5cf6);">

          <!-- Grid Background -->
          <div class="absolute inset-0">
               <svg class="w-full h-full" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice">
                    <defs>
                         <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                              <path d="M 10 0 L 0 0 0 10"
                                   fill="none"
                                   stroke="rgba(255,255,255,0.2)"
                                   stroke-width="0.5" />
                         </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
               </svg>
          </div>

          <!-- Content -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-20 fade-in">
               <div class="text-white max-w-4xl">

                    <!-- Badge -->
                    <div class="inline-block mb-6">
                         <span
                              class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                              Learning Management System v1.0
                         </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight text-shadow">
                         Empowering Filipinos with High-Paying, High-Value In-Demand Skills
                    </h1>

                    <!-- Brand Name -->
                    <div class="mb-8">
                         <h2 class="text-6xl lg:text-7xl font-black text-yellow-400 text-shadow">
                              LUMEN GENERATION
                         </h2>
                         <div class="h-1 w-64 bg-yellow-400 mt-4 rounded-full"></div>
                    </div>

                    <!-- Tagline -->
                    <p class="text-xl lg:text-2xl mb-10 leading-relaxed text-blue-100">
                         Advocating for a Generation of multi-skilled, competitive, and world-class Filipino workforce.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                         <a href="#features"
                              class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-yellow-300 transition-colors shadow-lg">
                              About
                         </a>

                         <a href="{{ route('login') }}"
                              class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-700 transition-colors">
                              Get Started
                         </a>
                    </div>

               </div>
          </div>

          <!-- Floating Middle Right Image -->
          <img
               src="{{ asset('storage/logo/tesdalogo.png') }}"
               alt="Lumen Illustration"
               class="hidden lg:block absolute right-10 top-1/2 h-[65%] opacity-50 pointer-events-none z-10 float" />

          <!-- Decorative Elements -->
          <div class="absolute top-20 right-20 w-32 h-32 bg-white/10 rounded-full"></div>
          <div class="absolute bottom-20 left-20 w-24 h-24 bg-yellow-400/20 rounded-full"></div>
          <div class="absolute top-1/2 right-10 w-40 h-40 bg-purple-400/10 rounded-full"></div>

     </section>

     <!-- Features Section -->
     <section id="features" class="py-20 bg-white">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
               <div class="text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                         Why Choose Lumen Generation?
                    </h2>
                    <p class="text-xl text-gray-600">
                         Building the future of Filipino excellence, one skill at a time.
                    </p>
               </div>
          </div>
     </section>

</body>

</html>