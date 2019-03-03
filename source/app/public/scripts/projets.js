
$(document).ready(() => {
    $(".section").each(i => {
        let parent = $(".section")[i];
        
        $(".line", parent).height($(parent).height());
    });

    $(".section").resize(() => {
        $(".section").each(i => {
            let parent = $(".section")[i];
            
            $(".line", parent).height($(parent).height());
        });
    })
})