<?php $this->load->view('blocks/head'); ?>

<div id="container">
    <div id="header">
		<?php $this->load->view('blocks/menu'); ?>
		<?php $this->load->view('blocks/slider'); ?>
    </div>
    <div id="body">
        <div class="border">
            <div class="content">
                <div class="row row-m">
                    <div class="col-md-12">
                        <h2>По согласованию с Вами мы выполним следующие виды работ:</h2>
                    </div>
                </div>
                <div class="mt40"></div>
                <div class="item-container m-l1">
                    <div class="row row-m index-items">
                        <?php if ($indexItems) : ?>
                            <?php foreach ($indexItems as $key => $item) : ?>
                                <div class="col-sm-12 col-md-12 index-item">
                                    <div class="">
                                        <div class="col-md-4">
                                            <img class="" src="<?=$item->preview?>">
                                        </div>

                                        <div class="col-md-7">
                                            <div class="index-text">
                                                <span><?=$item->title?></span>
                                                <div><?=$item->description?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/show/<?=$item->item_id?>">
                                        <button class="index-more-btn">Подробнее</button>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt40"></div>
    </div>
    <div id="footer">
		<?php $this->load->view('blocks/footer'); ?>
    </div>
</div>
