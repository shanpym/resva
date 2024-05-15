<style>
    #cg-progress {
    display: block;
    width: 100%;
    font-size: 0.6em;
    margin: 0px;
    padding: 15px 0px 0px;
    }
    #cg-progress > .step {
    display: inline-grid;
    margin: 0px;
    padding: 0px;
    }
    #cg-progress > .step > span {
    text-align: center;
    }
    #cg-progress > .step > .dot-base {
    position: relative;
    width: 25px;
    height: 25px;
    margin: 15px auto 0px;
    border-radius: 50%;
    background: #bbb;
    }
    #cg-progress > .step > .dot-base > .dot {
    position: relative;
    width: 15px;
    height: 15px;
    margin: calc( 50% - 7px ) auto;
    border-radius: 50%;
    background: #bbb;
    }
    #cg-progress > .step.active > .dot-base > .dot {
        background: #0474dc;
        z-index: 1;
    }
    #cg-progress > .step > .line {
    width: 100%;
    display: block;
    position: relative;
    height: 3px;
    left: calc(-50%);
    top: -14px;
    background: #bbb;
    }
    #cg-progress > .step.active > .line {
    background: #0474dc;
    }

    @media (max-width: 1024px) {
        #cg-progress {
            display: none;
        }
        }
</style>

<div id="cg-progress">
    <div class="step active" id="first-step">
      <div class="dot-base">
        <div class="dot"></div>
      </div>
      <span style="width: 300px"><h6 class="text-muted mt-2">Step 1</h6></span>
    </div>
    <div class="step" id="second-step">
      <div class="dot-base">
        <div class="dot"></div>
      </div>
      <div class="line"></div>
      <span style="width: 300px"><h6 class="text-muted mt-2">Step 2</h6></span>
    </div>
      <div class="step" id="last-step" >
        <div class="dot-base">
          <div class="dot"></div>
        </div>
        <div class="line"></div>
        <span style="width: 300px"><h6 class="text-muted mt-2">Invoice</h6></span>
    </div>
  </div>