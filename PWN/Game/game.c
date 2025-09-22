#include <stdio.h>
#include <stdlib.h>

void win() {
    system("cat flag.txt");
}

int main() {
    setbuf(stdout, NULL);

    srand(123456);          
    int secret = rand() % 1000000;  
    int guess;

    printf("Guess the secret number (0-999999): ");
    if(scanf("%d", &guess) != 1) exit(0);

    if(guess == secret) {
        printf("Correct! Here's the flag:\n");
        win();
    } else {
        printf("Wrong guess. Try again!\n");
    }

    return 0;
}
