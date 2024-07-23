<?php $this->assign('title', 'responsive test'); ?>
<!-- default.php 레이아웃에 포함될 테스트 페이지 내용 -->
<!-- <div class="container mx-auto mt-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム1</h2>
            <p>テストです 1.</p>
        </div>
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム2</h2>
            <p>テストです 2.</p>
        </div>
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム3</h2>
            <p>テストです 3.</p>
        </div>
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム4</h2>
            <p>テストです 4.</p>
        </div>
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム5</h2>
            <p>テストです 5.</p>
        </div>
        <div class="p-4 bg-gray-100 rounded shadow">
            <h2 class="text-xl font-bold">カラム6</h2>
            <p>テストです 6.</p>
        </div>
    </div>
</div> -->
<!-- table test-->
<div class="container mt-5">
    <div class="">
        <div class="">
            <label for="master" class="text-base sm:text-xl md:text-2xl lg:text-3xl text-center">
                ※マスターデータ選択で内容が確認できます。
            </label>
            <div class="">
                <select id="master" class="">
                        <option value="">テストです。</option>
                </select>
            </div>
            <div id="values" class="">
                <table id="values-table" class="">
                    <thead class="">
                        <tr class="">
                            <th class="bg-sky-50 text-center text-base sm:text-xl md:text-2xl lg:text-3xl tracking-tighter">test</th>
                            <th class="bg-sky-50 text-center text-base sm:text-xl md:text-2xl lg:text-3xl tracking-tighter">test</th>
                            <th class="bg-sky-50 text-center text-base sm:text-xl md:text-2xl lg:text-3xl tracking-tighter">test</th>
                        </tr>
                    </thead>
                    <tbody id="valuesBody">
                        <!-- Data will be added here via AJAX -->
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>


<!--
640픽셀 이하의 경우, Tailwind CSS는 기본적으로 설정된 클래스들이 적용됨. 
Tailwind CSS는 모바일 우선 접근 방식(mobile-first approach)을 따르고 있어, 
640픽셀 이하에서는 sm, md, lg 등의 브레이크포인트를 지정하지 않은 기본 스타일이 적용됨..

모바일 우선 접근 방식
Tailwind CSS에서는 기본적으로 모바일에 적용될 스타일을 정의하고, 
더 큰 화면에 대해 sm, md, lg 등의 브레이크포인트를 사용하여 스타일을 확장한다.. 
예를 들어, grid-cols-1은 기본적으로 모든 화면 크기에서 적용되지만, sm:grid-cols-2, md:grid-cols-3 등은 더 큰 화면에서만 적용된다.

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <div class="p-4 bg-gray-100 rounded shadow">
        <h2 class="text-xl font-bold">Column 1</h2>
        <p>Content for column 1.</p>
    </div>
        나머지 컬럼들..
    </div>

위 코드에서 grid-cols-1은 기본적으로 640픽셀 이하의 모든 화면 크기에서 적용된다.. 
화면이 더 커질 때마다 sm:grid-cols-2, md:grid-cols-3, lg:grid-cols-4가 순차적으로 적용된다.

따라서 640픽셀 이하에서는 특별한 브레이크포인트 설정 없이 기본 스타일이 적용되며, 
이를 통해 반응형 디자인을 구현할 수 있다..

정리
640픽셀 이하: 기본 스타일 (grid-cols-1)
640픽셀 이상: sm 스타일 (sm:grid-cols-2)
768픽셀 이상: md 스타일 (md:grid-cols-3)
1024픽셀 이상: lg 스타일 (lg:grid-cols-4)
이 방식으로 Tailwind CSS는 작은 화면에서부터 큰 화면까지 자연스럽게 반응형 디자인을 지원한다.

-->
