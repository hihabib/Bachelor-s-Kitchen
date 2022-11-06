// Take two inputs from user and find their summation, average, Multiplication, division, subtraction, modulation by using function use different function for different task such as use function summation() for summation.

#include <stdio.h>


void main(){
    int x, y;
    scanf("%d", &x);
    scanf("%d", &y);

    void summation(int x, int y){
        int sum = x + y;
        printf("Sum: %d\n", sum);
    }

    summation(x, y);

    void average(int x, int y){
        float average = ((float)x + (float)y) / (float)2;
        printf("Average: %.2f\n", average);
    }

    average(x,y);

    void multiplication(int x, int y){
        int mul = x * y;
        printf("Mul: %d\n", mul);
    }

    multiplication(x, y);

    void divition(int x, int y){
        float div = (float)x / (float)y;

        printf("Div: %.2f\n", div);
    }

    divition(x, y);

    void subtraction(int a, int b){
        int sub =  a - b;
        printf("Sub: %d\n", sub);
    }
    subtraction(x, y);


    void modulation(int x, int y){
        int mod = x % y;
        printf("Mod: %d\n", mod);
    }
    modulation(x, y);
}


