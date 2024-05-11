import matplotlib.pyplot as plt
from collections import Counter

def hailstone(n):
    sequence = [n]
    steps = 0
    while n != 1:
        if n % 2 == 0:
            n //= 2
        else:
            n = 3 * n + 1
        sequence.append(1/n) #Only Difference from Collatz.py
        steps += 1
    return sequence, steps

def graph(start, end):
    stepCount = []
    for num in range(start, end + 1):
        sequence, steps = hailstone(num)
        plt.plot(sequence)
        stepCount.append(steps)

    plt.xlabel('Number of Steps')
    plt.ylabel('Numbers')
    plt.title('Hailstone Sequence')
    plt.legend()
    plt.show()

    counter = Counter(stepCount)

    print("Common number of steps:")
    for steps, count in counter.most_common():
        print(f"{steps} steps: {count} times")

if __name__ == "__main__":
    start = int(input("Enter the first number: "))
    end = int(input("Enter the last number: "))
    graph(start, end)
