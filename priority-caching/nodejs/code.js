const readline = require('readline');
const fs = require('fs');

function cacheContents(callLogs) {
    let cache = [];
    let priority = {};
    for (let log of callLogs) {
        let time = log[0];
        let item = log[1];
        if (!priority[item]) {
            priority[item] = 0;
        }
        priority[item] += 2;
        if (priority[item] > 5 && !cache.includes(item)) {
            cache.push(item);
        }
        for (let i = 0; i < cache.length; i++) {
            let cachedItem = cache[i];
            priority[cachedItem]--;
            if (priority[cachedItem] <= 3) {
                cache.splice(i, 1);
            }
        }
    }
    cache.sort();
    return cache;
}

let rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout,
    terminal: false
});

let input = [];
rl.on('line', function(line){
    input.push(line.trim().split(' ').map(Number));
    if(input.length === input[0][0] + 2) {
        let result = cacheContents(input.slice(2));
        let outputPath = process.env.OUTPUT_PATH && process.env.OUTPUT_PATH !== '' ? process.env.OUTPUT_PATH : 'output.txt';
        fs.writeFileSync(outputPath, result.join('\n') + '\n');
        rl.close();
    }
});
