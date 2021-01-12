        <div class="c-sidebar-brand">
            <img class="c-sidebar-brand-full" src="{{ url('/frontend/image/logo-white.png') }}" width="118" height="46" alt="CoreUI Logo">
            <img class="c-sidebar-brand-minimized" src="{{ url('/frontend/image/logo-white.png') }}" width="118" height="46" alt="CoreUI Logo">
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-title">BookHorizon</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('dashboard')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('book.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Book
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('supplier.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Suppier
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('transaction.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Transactions
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('bank.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Banks
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('author.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Authors
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('member.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Members
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('membership.index')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Memberships
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>