<header class="bg-white h-[70px] px-[30px] flex justify-between items-center shadow-[0_1px_3px_rgba(0,0,0,0.05)] z-[5] shrink-0">

    <div class="flex items-center bg-bg-color rounded-[8px] px-[15px] py-[8px] w-[300px] border border-border">
        <span class="text-text-muted mr-[8px]">🔍</span>
        <input type="text" placeholder="Cari data..." class="border-none bg-transparent outline-none w-full font-sans text-[14px]">
    </div>

    <div class="flex items-center gap-[15px]">
        <div class="text-right hidden sm:block">
            <p class="m-0 font-semibold text-[14px] text-text-main">{{session()->get('name')}}</p>
            <p class="m-0 text-[12px] text-text-muted">{{session()->get('email')}}</p>
        </div>
        <div class="w-[40px] h-[40px] rounded-full bg-primary text-white flex justify-center items-center font-bold text-[16px]">
            AD
        </div>
    </div>

</header>